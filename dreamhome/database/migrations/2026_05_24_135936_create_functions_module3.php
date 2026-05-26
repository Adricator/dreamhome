<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{

    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. TRIGGER & FUNCTION: Enforce Job Position Constraints
        |--------------------------------------------------------------------------
        | Case Study Requirement: Only Managers get Car Allowances and Monthly Performance Bonuses.
        | Only Secretaries have a Typing Speed recorded.
        |
        */
        DB::unprepared("
            CREATE OR REPLACE FUNCTION validate_staff_position_attributes()
            RETURNS TRIGGER AS $$
            BEGIN
                -- Standardize case formatting to avoid string matching validation bypasses
                NEW.position := LOWER(NEW.position);

                -- Rule A: If not a manager, strip out manager financial configurations
                IF NEW.position != 'manager' THEN
                    NEW.car_allowance := NULL;
                    NEW.performance_bonus := NULL;
                    NEW.supervised_by := NULL;
                END IF;

                -- Rule B: If not a secretary, strip out administrative typing statistics
                IF NEW.position != 'secretary' THEN
                    NEW.typing_speed_wpm := NULL;
                END IF;

                IF NEW.position != 'supervisor' THEN
                    NEW.supervised_by := NULL;
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        DB::unprepared("
            CREATE OR REPLACE TRIGGER trg_validate_staff_position_attributes
            BEFORE INSERT OR UPDATE ON staff
            FOR EACH ROW
            EXECUTE FUNCTION validate_staff_position_attributes();
        ");

        DB::unprepared("
            CREATE OR REPLACE FUNCTION sync_and_validate_branch_manager()
            RETURNS TRIGGER AS $$
            DECLARE
                current_branch_manager VARCHAR;
            BEGIN
                -- 1. If the staff member's position is set to 'manager'
                IF LOWER(NEW.position) = 'manager' THEN
                    
                    -- Check who currently manages this branch in the branches table
                    SELECT manager_id INTO current_branch_manager
                    FROM branches
                    WHERE branch_id = NEW.branch_id;

                    -- If another staff member is already assigned there, block the action
                    IF current_branch_manager IS NOT NULL AND current_branch_manager != NEW.staff_id THEN
                        RAISE EXCEPTION 'Database Constraint Violation: Branch % already has an active manager (Staff ID: %). You must demote or transfer them first.', 
                            NEW.branch_id, current_branch_manager;
                    END IF;

                    -- Update the branch to reference this new manager's staff_id
                    UPDATE branches
                    SET manager_id = NEW.staff_id
                    WHERE branch_id = NEW.branch_id;

                -- 2. HANDLE DEMOTIONS/TRANSFERS: If they used to be a manager but aren't anymore,
                -- clear the manager slot on the branch they just left.
                ELSIF TG_OP = 'UPDATE' AND LOWER(OLD.position) = 'manager' THEN
                    UPDATE branches
                    SET manager_id = NULL
                    WHERE branch_id = OLD.branch_id AND manager_id = OLD.staff_id;
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        /*
        |--------------------------------------------------------------------------
        | TRIGGER: trg_sync_and_validate_branch_manager
        |--------------------------------------------------------------------------
        | Set to AFTER INSERT OR UPDATE so the staff row is guaranteed to exist
        | in the database before the branches foreign key tries to look for it.
        |
        */
        DB::unprepared("
            DROP TRIGGER IF EXISTS trg_sync_and_validate_branch_manager ON staff;
            
            CREATE TRIGGER trg_sync_and_validate_branch_manager
            AFTER INSERT OR UPDATE OF position, branch_id ON staff
            FOR EACH ROW
            EXECUTE FUNCTION sync_and_validate_branch_manager();
        ");

        DB::unprepared("
            CREATE OR REPLACE FUNCTION validate_supervisor_capacity()
            RETURNS TRIGGER AS $$
            DECLARE
                current_team_count INTEGER;
                supervisor_title VARCHAR;
            BEGIN
                -- Only execute check if the staff member is being assigned to a supervisor
                IF NEW.supervised_by IS NOT NULL THEN

                    -- 1. Verify that the targeted 'supervised_by' ID actually belongs to a Supervisor
                    SELECT LOWER(position) INTO supervisor_title
                    FROM staff
                    WHERE staff_id = NEW.supervised_by;

                    IF supervisor_title != 'supervisor' THEN
                        RAISE EXCEPTION 'Database Constraint Violation: Staff member % is a %, not a Supervisor. Only Supervisors can manage a staff group.',
                            NEW.supervised_by, supervisor_title;
                    END IF;

                    -- 2. Count current active team members (excluding the current staff member if it's an update)
                    SELECT COUNT(*) INTO current_team_count
                    FROM staff
                    WHERE supervised_by = NEW.supervised_by
                      AND staff_id != NEW.staff_id;

                    -- 3. Block transaction if the team capacity ceiling is breached
                    IF current_team_count >= 10 THEN
                        RAISE EXCEPTION 'Database Constraint Violation: Supervisor % already handles the maximum limit of 10 staff members. Cannot assign more.',
                            NEW.supervised_by;
                    END IF;

                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trg_sync_and_validate_branch_manager ON staff;");
        DB::unprepared("DROP FUNCTION IF EXISTS sync_and_validate_branch_manager();");
        DB::unprepared("DROP PROCEDURE IF EXISTS promote_staff_to_manager(VARCHAR, VARCHAR, DECIMAL, DECIMAL);");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_check_supervisor_group_capacity ON staff;");
        DB::unprepared("DROP FUNCTION IF EXISTS check_supervisor_group_capacity();");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_validate_staff_position_attributes ON staff;");
        DB::unprepared("DROP FUNCTION IF EXISTS validate_staff_position_attributes();");
        DB::unprepared("DROP TRIGGER IF EXISTS trg_validate_supervisor_capacity ON staff;");
        DB::unprepared("DROP FUNCTION IF EXISTS validate_supervisor_capacity();");
    }
};
