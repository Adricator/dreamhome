-- ADVERTISEMENT
INSERT INTO Advertisement (ad_id, property_id, media_source, date_advertised, cost) VALUES
('AD001', 'PR001', 'Online', '2024-06-01', 500.00),
('AD002', 'PR002', 'Newspaper', '2024-06-05', 300.00),
('AD003', NULL, 'Online', '2024-06-10', 450.00);

-- BRANCH
INSERT INTO Branch (branch_id, street, area, city, postcode, telephone_no, fax_no) VALUES
('BR001', 'Baker Street', 'Marylebone', 'London', 'NW1 6XE', '02079460001', '02079460002'),
('BR002', 'Deansgate', 'City Centre', 'Manchester', 'M3 2BW', '01618300001', '01618300002'),
('BR003', 'Princes Street', 'Old Town', 'Edinburgh', 'EH2 2ER', '01315500001', '01315500002'),
('BR004', 'Broad Street', 'Central', 'Birmingham', 'B1 2HF', '01216300001', '01216300002'),
('BR005', 'Park Row', 'City Centre', 'Leeds', 'LS1 5AB', '01132400001', '01132400002');

-- CLIENT
INSERT INTO Client (client_id, first_name, last_name, address, telephone_no, email, prefer_type, max_rent) VALUES
('CLI001', 'Emily', 'Davis', '34 High Street, London', '+447911987654', 'emily.davis@example.com', 'apartment', 1200.00),
('CLI002', 'James', 'Miller', '56 Market Street, Manchester', '+447922876543', 'james.miller@example.com', 'house', 1500.00),
('CLI003', 'Olivia', 'Wilson', '78 Princes Street, Edinburgh', '+447933765432', 'olivia.wilson@example.com', 'apartment', 1000.00),
('CLI004', 'Liam', 'Johnson', '12 Broad Street, Birmingham', '+447944654321', 'liam.johnson@example.com', 'house', 1800.00),
('CLI005', 'Sophia', 'Brown', '90 Park Lane, Leeds', '+447955543210', 'sophia.brown@example.com', 'apartment', 1100.00);

-- INSPECTION
INSERT INTO Inspection (inspection_id, property_id, staff_id, date, comment) VALUES
('INS001', 'PROP001', 'ST001', '2024-05-01', 'passed'),
('INS002', 'PROP002', 'ST002', '2024-05-02', 'failed'),
('INS003', 'PROP003', 'ST003', '2024-05-03', 'passed'),
('INS004', 'PROP004', 'ST004', '2024-05-04', 'failed'),
('INS005', 'PROP005', 'ST005', '2024-05-05', 'passed');

-- LEASE
INSERT INTO Lease (lease_id, property_id, client_id, payment_method, deposit, deposit_paid, staff_id, start_date, end_date, duration_months) VALUES
('LE001', 'PR001', 'CLI001', 'credit_card', 1200.00, TRUE, 'ST001', '2024-06-01', '2025-05-31', 12),
('LE002', 'PR002', 'CLI002', 'debit_card', 1500.00, TRUE, 'ST002', '2024-07-01', '2025-06-30', 12),
('LE003', 'PR003', 'CLI003', 'bank_transfer', 1000.00, TRUE, 'ST003', '2024-08-01', '2025-07-31', 12),
('LE004', 'PR004', 'CLI004', 'cash', 1300.00, TRUE, 'ST004', '2024-09-01', '2025-08-31', 12),
('LE005', 'PR005', 'CLI005', 'credit_card', 1100.00, TRUE, 'ST005', '2024-10-01', '2025-09-30', 12);

-- NEXT OF KIN
INSERT INTO NextOfKin (staff_id, full_name, relationship, address, telephone_no) VALUES
('ST001', 'John Doe', 'sister', '123 Main St, Anytown', '07123456789'),
('ST002', 'Jane Smith', 'brother', '456 Elm St, Othertown', '07234567890'),
('ST003', 'Emily Johnson', 'mother', '789 Oak St, Sometown', '07345678901');

-- OWNER
INSERT INTO Owner (owner_id, first_name, last_name, address, telephone_no, email) VALUES
('OWN001', 'Oliver', 'Smith', '12 Baker Street, London', '+447911123456', 'oliver.smith@email.co.uk'),
('OWN002', 'Amelia', 'Johnson', '45 Deansgate, Manchester', '+447922234567', 'amelia.johnson@email.co.uk'),
('OWN003', 'George', 'Brown', '78 Princes Street, Edinburgh', '+447933345678', 'george.brown@email.co.uk'),
('OWN004', 'Isla', 'Taylor', '22 Broad Street, Birmingham', '+447944456789', 'isla.taylor@email.co.uk'),
('OWN005', 'Harry', 'Wilson', '10 Park Lane, Leeds', '+447955567890', 'harry.wilson@email.co.uk');

-- PAYMENT
INSERT INTO Payment (payment_id, lease_id, payment_date, amount, payment_method) VALUES
('PAY001', 'LE001', '2023-01-01', 1200.00, 'credit_card'),
('PAY002', 'LE002', '2023-02-01', 1300.00, 'debit_card');

-- PROPERTY
INSERT INTO Property (property_id, owner_id, branch_id, staff_id, street, area, city, postcode, type, rooms, monthly_rent, status) VALUES
('PR001', 'OWN001', 'BR001', 'ST001', '221B Baker Street', 'Marylebone', 'London', 'NW1 6XE', 'Apartment', 3, 2500, 'available'),
('PR002', 'OWN002', 'BR002', 'ST002', '50 Deansgate', 'City Centre', 'Manchester', 'M3 2BW', 'Condo', 2, 1800, 'rented'),
('PR003', 'OWN003', 'BR003', 'ST003', '10 Princes Street', 'Old Town', 'Edinburgh', 'EH2 2ER', 'House', 4, 3200, 'maintenance'),
('PR004', 'OWN004', 'BR004', 'ST004', '5 Broad Street', 'Central', 'Birmingham', 'B1 2HF', 'Apartment', 3, 2200, 'reserved');

-- REGISTRATION
INSERT INTO Registration (client_id, staff_id, branch_id, date_joined) VALUES
('CL001', 'ST001', 'BR001', '2020-01-15'),
('CL001', 'ST002', 'BR002', '2021-06-10'),
('CL001', 'ST003', 'BR003', '2022-02-20'),
('CL001', 'ST004', 'BR004', '2019-08-01');

-- STAFF
INSERT INTO Staff (staff_id, first_name, last_name, address, telephone_no, sex, dob, nin, position, salary, date_joined) VALUES
('ST001', 'Emily', 'Clark', 'London', '+447700111111', 'female', '1990-03-12', 'NIN001', 'manager', 40000, '2020-01-15'),
('ST002', 'Jack', 'White', 'Manchester', '+447700222222', 'male', '1988-07-22', 'NIN002', 'supervisor', 32000, '2021-06-10'),
('ST003', 'Sophia', 'Green', 'Edinburgh', '+447700333333', 'female', '1995-11-05', 'NIN003', 'assistant', 28000, '2022-02-20'),
('ST004', 'Liam', 'Hall', 'Birmingham', '+447700444444', 'male', '1992-09-18', 'NIN004', 'manager', 41000, '2019-08-01'),
('ST005', 'Mia', 'Allen', 'Leeds', '+447700555555', 'female', '1998-01-30', 'NIN005', 'assistant', 27000, '2023-03-12'),
('ST006', 'Chloe', 'Bennett', 'London', '+447700666666', 'female', '1996-06-14', 'NIN006', 'secretary', 26000, '2023-09-01'),
('ST007', 'Ethan', 'Scott', 'Manchester', '+447700777777', 'male', '1994-12-08', 'NIN007', 'assistant', 28000, '2022-11-15');

-- VIEWING
INSERT INTO Viewing (viewing_id, client_id, property_id, viewing_date, comments) VALUES
('V001', 'CL001', 'PR001', '2023-10-01', 'scheduled'),
('V002', 'CL002', 'PR002', '2023-10-05', 'completed'),
('V003', 'CL003', 'PR003', '2023-10-10', 'cancelled');
