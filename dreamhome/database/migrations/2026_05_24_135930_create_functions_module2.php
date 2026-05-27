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
        DB::unprepared('DROP TRIGGER IF EXISTS before_client_insert_assign_staff ON clients CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS auto_assign_staff_to_client() CASCADE;');

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
    branch_id varchar,
    staff_id varchar
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
        c.branch_id::varchar,
        c.staff_id::varchar
    FROM clients c
    WHERE c.client_id = TRIM(client_id_input);
END;
$$ LANGUAGE plpgsql;
-- SELECT *
-- FROM get_client_info('client number');
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
    SET branch_id = normalized_branch_id,
        staff_id = NULL
    WHERE client_id = normalized_client_id;

    IF NOT FOUND THEN
        RAISE EXCEPTION 'Client does not exist';
    END IF;
END;
$$;
-- CALL assign_branch_to_client('Client', 'Branch');

-- SELECT client_id, branch_id, staff_id
-- FROM clients
-- WHERE client_id = 'Client';
SQL
        );

        // Trigger function: Auto-assign staff when a client is created
        DB::unprepared(<<<'SQL'
CREATE OR REPLACE FUNCTION auto_assign_staff_to_client()
RETURNS trigger
LANGUAGE plpgsql
AS $$
DECLARE
    selected_staff_id varchar;
    selected_branch_id varchar;
BEGIN
    IF NEW.staff_id IS NOT NULL THEN
        SELECT s.staff_id, s.branch_id
        INTO selected_staff_id, selected_branch_id
        FROM staff s
        WHERE s.staff_id = TRIM(NEW.staff_id);

        IF selected_staff_id IS NULL THEN
            RAISE EXCEPTION 'Staff does not exist';
        END IF;

        NEW.staff_id := selected_staff_id;
        NEW.branch_id := selected_branch_id;

        RETURN NEW;
    END IF;

    SELECT s.staff_id, s.branch_id
    INTO selected_staff_id, selected_branch_id
    FROM staff s
    LEFT JOIN clients c ON c.staff_id = s.staff_id
    WHERE NEW.branch_id IS NULL OR s.branch_id = NEW.branch_id
    GROUP BY s.staff_id, s.branch_id
    ORDER BY COUNT(c.client_id), s.staff_id
    LIMIT 1;

    IF selected_staff_id IS NULL THEN
        RAISE EXCEPTION 'No staff available to assign to client';
    END IF;

    NEW.staff_id := selected_staff_id;
    NEW.branch_id := selected_branch_id;

    RETURN NEW;
END;
$$;

CREATE TRIGGER before_client_insert_assign_staff
BEFORE INSERT ON clients
FOR EACH ROW
EXECUTE FUNCTION auto_assign_staff_to_client();
SQL
        );
    }
// INSERT INTO clients (
//     client_id,
//     first_name,
//     last_name,
//     address,
//     telephone_no,
//     email,
//     prefer_type,
//     max_rent,
//     password,
//     branch_id
// )
// VALUES (
//     'CL999',
//     'Test',
//     'Trigger',
//     'Test Address',
//     '0000000000',
//     'trigger-test@example.com',
//     'House',
//     1000,
//     'temporary-password',
//     'BR001'
// );
// CHECKING
// SELECT client_id, branch_id, staff_id
// FROM clients
// WHERE client_id = 'CL999';


    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS before_client_insert_assign_staff ON clients CASCADE;');
        DB::unprepared('DROP FUNCTION IF EXISTS auto_assign_staff_to_client() CASCADE;');
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
