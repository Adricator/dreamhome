-----TABLES FOR DATABASE-----
CREATE TABLE advertisements (
    ad_id varchar(20) PRIMARY KEY,
    property_id varchar(20) NOT NULL REFERENCES properties(property_id),
    media_source varchar(50) NOT NULL,
    date_advertised date NOT NULL,
    cost numeric(10,2) NOT NULL,
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE properties (
    property_id varchar(255) PRIMARY KEY,
    owner_id varchar(255) NOT NULL REFERENCES owners(owner_id),
    branch_id varchar(255) NOT NULL REFERENCES branches(branch_id),
    staff_id varchar(255) REFERENCES staff(staff_id),
    street varchar(255) NOT NULL,
    area varchar(255) NOT NULL,
    city varchar(255) NOT NULL,
    postcode varchar(255) NOT NULL,
    type varchar(255) NOT NULL,
    rooms integer NOT NULL,
    monthly_rent numeric(10,2) NOT NULL,
    status varchar(255) NOT NULL DEFAULT 'available',
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE leases (
    lease_id varchar(255) PRIMARY KEY,
    property_id varchar(255) NOT NULL REFERENCES properties(property_id),
    client_id varchar(255) NOT NULL REFERENCES clients(client_id),
    staff_id varchar(255) NOT NULL REFERENCES staff(staff_id),
    payment_method varchar(255) NOT NULL,
    deposit numeric(10,2) NOT NULL,
    deposit_paid boolean NOT NULL DEFAULT false,
    start_date date NOT NULL,
    end_date date NOT NULL,
    duration_months integer NOT NULL,
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE payments (
    payment_no integer NOT NULL,
    lease_id varchar(255) NOT NULL REFERENCES leases(lease_id),
    amount numeric(10,2) NOT NULL,
    payment_date date NOT NULL,
    payment_method varchar(255) NOT NULL,
    PRIMARY KEY (payment_no, lease_id)
);
CREATE TABLE viewings (
    id bigint PRIMARY KEY,
    client_id varchar(20) NOT NULL REFERENCES clients(client_id),
    property_id varchar(20) NOT NULL REFERENCES properties(property_id),
    view_date date,
    staff_id varchar(20) REFERENCES staff(staff_id),
    comments text,
    status varchar(255) NOT NULL DEFAULT 'Pending'
);
CREATE TABLE inspections (
    inspection_id uuid PRIMARY KEY,
    property_id varchar(20) NOT NULL,
    inspection_date date NOT NULL,
    staff_id varchar(20) NOT NULL,
    comments text,
    created_at timestamp,
    updated_at timestamp
);
CREATE TABLE next_of_kin (
    staff_id varchar(255) NOT NULL,
    full_name varchar(255) NOT NULL,
    relationship varchar(255) NOT NULL,
    address text NOT NULL,
    telephone_no varchar(255) NOT NULL UNIQUE
);
CREATE TABLE users (
    id bigint PRIMARY KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    remember_token varchar(100),
    created_at timestamp,
    updated_at timestamp
);
