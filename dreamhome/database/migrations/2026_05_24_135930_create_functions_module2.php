<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old functions/procedures if they exist
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(varchar) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(varchar, varchar, varchar, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(text, text, text, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_branch_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_branch_to_client(text, text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(text, text) CASCADE;');

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
    max_rent numeric,
    branch_id varchar
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
        c.max_rent::numeric,
        c.branch_id::varchar
    FROM clients c
    WHERE c.client_id = TRIM(client_id_input);
END;
$$ LANGUAGE plpgsql;
SQL
        );

        // Procedure: Assign branch to client
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE PROCEDURE assign_branch_to_client(
    client_id_input varchar,
    branch_id_input varchar
)
LANGUAGE plpgsql
AS $$
DECLARE
    normalized_client_id varchar := TRIM(client_id_input);
    normalized_branch_id varchar := TRIM(branch_id_input);
BEGIN
    IF NOT EXISTS (
        SELECT 1
        FROM branches b
        WHERE b.branch_id = normalized_branch_id
    ) THEN
        RAISE EXCEPTION 'Branch does not exist';
    END IF;

    UPDATE clients
    SET branch_id = normalized_branch_id
    WHERE client_id = normalized_client_id;

    IF NOT FOUND THEN
        RAISE EXCEPTION 'Client does not exist';
    END IF;
END;
$$;
SQL
        );

        // Procedure: Assign staff branch to client
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

    -- Assign the client to the staff member's branch
    UPDATE clients
    SET branch_id = staff_branch_id
    WHERE client_id = TRIM(client_id_input);

    IF NOT FOUND THEN
        RAISE EXCEPTION 'Client does not exist';
    END IF;
END;
$$;
SQL
        );
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_branch_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_branch_to_client(text, text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(varchar, varchar) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS assign_staff_to_client(text, text) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(varchar, varchar, varchar, date) CASCADE;');
        DB::unprepared('DROP PROCEDURE IF EXISTS register_client(text, text, text, date) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(varchar) CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS get_client_info(text) CASCADE;');
    }
};
