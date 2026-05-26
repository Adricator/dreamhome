<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old functions/procedures if they exist
        DB::unprepared('DROP TRIGGER IF EXISTS after_registration_insert ON registrations CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(varchar) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(varchar, varchar, varchar, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(text, text, text, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(text, text) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS log_client_registration() CASCADE;');

        // Create function: get_client_info
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE FUNCTION get_client_info(client_id_input varchar)
RETURNS TABLE (
    first_name varchar,
    last_name varchar,
    address text,
    telephone_no varchar,
    email text,
    prefer_type text,
    max_rent numeric
)
AS $$
BEGIN
    RETURN QUERY
    SELECT
        c.first_name::varchar,
        c.last_name::varchar,
        c.address::text,
        c.telephone_no::varchar,
        c.email::text,
        c.prefer_type::text,
        c.max_rent::numeric
    FROM clients c
    WHERE c.client_id = TRIM(client_id_input);
END;
$$ LANGUAGE plpgsql;
SQL
        );

        // Procedure: Assign staff to client
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE PROCEDURE assign_staff_to_client(
    client_id_input varchar,
    staff_id_input varchar
)
LANGUAGE plpgsql
AS $$
DECLARE
    staff_branch_id varchar;
BEGIN
    -- Check if staff exists
    SELECT s.branch_id
    INTO staff_branch_id
    FROM staff s
    WHERE s.staff_id = TRIM(staff_id_input);

    IF staff_branch_id IS NULL THEN
        RAISE EXCEPTION 'Staff does not exist';
    END IF;

    -- Assign staff to client
    UPDATE registrations
    SET staff_id = TRIM(staff_id_input),
        branch_id = staff_branch_id
    WHERE client_id = TRIM(client_id_input);

    IF NOT FOUND THEN
        RAISE EXCEPTION 'Client is not registered';
    END IF;
END;
$$;
SQL
        );

        // Create trigger: log_registration
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE FUNCTION log_client_registration()
RETURNS trigger
LANGUAGE plpgsql
AS $$
BEGIN
    RAISE NOTICE 'Client % registered to branch % with staff %', NEW.client_id, NEW.branch_id, NEW.staff_id;
    RETURN NEW;
END;
$$;

CREATE TRIGGER after_registration_insert
AFTER INSERT ON registrations
FOR EACH ROW
EXECUTE FUNCTION log_client_registration();
SQL
        );
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_registration_insert ON registrations CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS log_client_registration() CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(text, text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(varchar, varchar, varchar, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(text, text, text, date) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(varchar) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(text) CASCADE;');
    }
};
