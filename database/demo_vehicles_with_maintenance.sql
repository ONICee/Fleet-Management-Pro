-- Demo Vehicles with Complete Maintenance History
-- State Fleet Management System
-- Run this after the main schema has been loaded

USE fleet_mgt;

-- ==================================================
-- INSERT 10 VEHICLES WITH REALISTIC DATA
-- ==================================================

INSERT INTO vehicles (
    vehicle_brand, vehicle_model, serial_number, year_allotted, year_manufactured,
    vehicle_type, fuel_type, engine_number, chassis_number, license_plate, vin,
    tracker_number, tracker_imei, tracker_status, agency_id, deployment_location_id,
    serviceability, current_condition, current_mileage, purchase_date, purchase_price,
    supplier, last_overhaul, next_overhaul, last_scheduled_maintenance, next_scheduled_maintenance,
    insurance_policy, insurance_expiry, registration_expiry, status
) VALUES

-- Vehicle 1: Police Patrol Car
('Toyota', 'Camry Police Edition', 'SPC-001-2024', 2024, 2024, 'car', 'gasoline',
'1GR-FE-8874521', 'JTDBT40X980123456', 'POL-001-NG', '4T1BF1FK8EU123456',
'TRK-POL-001', '860123456789012', 'active', 1, 1, 'serviceable',
'Good condition, regular patrol duty', 18500, '2024-01-15', 8500000.00,
'Toyota Nigeria Limited', '2024-01-15', '2025-01-15', '2024-10-15', '2025-01-15',
'POL-2024-001', '2025-01-14', '2025-01-14', 'active'),

-- Vehicle 2: FRSC Hilux
('Toyota', 'Hilux Double Cab', 'FRSC-002-2023', 2023, 2023, 'truck', 'diesel',
'2KD-FTV-7654321', 'MR0FB22G5M0123457', 'FRSC-002-NG', '8AJFB52E9JA123457',
'TRK-FRSC-002', '860123456789013', 'active', 2, 2, 'serviceable',
'Excellent condition, highway patrol', 35200, '2023-03-20', 12000000.00,
'Toyota Nigeria Limited', '2023-03-20', '2024-03-20', '2024-09-20', '2024-12-20',
'FRSC-2023-002', '2024-03-19', '2024-03-19', 'active'),

-- Vehicle 3: NSCDC Bus
('Hyundai', 'County Bus', 'NSCDC-003-2022', 2022, 2022, 'bus', 'diesel',
'D4AL-9876543', 'KMFHD12EXMA123458', 'NSCDC-003-NG', 'KMFHD12EXMA123458',
'TRK-NSCDC-003', '860123456789014', 'inactive', 3, 3, 'serviceable',
'Good condition, personnel transport', 67800, '2022-06-10', 15000000.00,
'Hyundai Motors Nigeria', '2022-06-10', '2023-06-10', '2024-06-10', '2024-12-10',
'NSCDC-2022-003', '2023-06-09', '2023-06-09', 'maintenance'),

-- Vehicle 4: Traffic Management Motorcycle
('Honda', 'CG 125', 'STMA-004-2024', 2024, 2024, 'motorcycle', 'gasoline',
'JC32E-1234567', 'ME4KC3210MA123459', 'STMA-004-NG', 'JH2KC3210MA123459',
'TRK-STMA-004', '860123456789015', 'active', 4, 4, 'serviceable',
'New motorcycle, traffic enforcement', 3200, '2024-05-01', 850000.00,
'Honda Motors Nigeria', NULL, '2025-05-01', '2024-08-01', '2024-11-01',
'STMA-2024-004', '2025-04-30', '2025-04-30', 'active'),

-- Vehicle 5: Customs Patrol Van
('Ford', 'Transit Custom', 'NCS-005-2023', 2023, 2023, 'van', 'diesel',
'PUMA-2.2L-5678901', 'WF0RXXTTGRMA123460', 'NCS-005-NG', 'WF0RXXTTGRMA123460',
'TRK-NCS-005', '860123456789016', 'active', 5, 6, 'serviceable',
'Border patrol vehicle, excellent condition', 29400, '2023-07-15', 9200000.00,
'Ford Motors Nigeria', NULL, '2024-07-15', '2024-07-15', '2024-10-15',
'NCS-2023-005', '2024-07-14', '2024-07-14', 'active'),

-- Vehicle 6: Immigration 4WD
('Mitsubishi', 'Pajero Sport', 'NIS-006-2021', 2021, 2021, 'car', 'diesel',
'4D56-VGT-2345678', 'MMBJNK64WMH123461', 'NIS-006-NG', 'MMBJNK64WMH123461',
'TRK-NIS-006', '860123456789017', 'active', 6, 7, 'serviceable',
'All-terrain vehicle, border operations', 78900, '2021-09-30', 11500000.00,
'Mitsubishi Motors Nigeria', '2021-09-30', '2022-09-30', '2024-06-30', '2024-12-30',
'NIS-2021-006', '2022-09-29', '2022-09-29', 'active'),

-- Vehicle 7: DSS Surveillance Van
('Mercedes-Benz', 'Sprinter 315 CDI', 'DSS-007-2022', 2022, 2022, 'van', 'diesel',
'OM651-3456789', 'WDB9066321S123462', 'DSS-007-NG', 'WDB9066321S123462',
'TRK-DSS-007', '860123456789018', 'active', 7, 8, 'serviceable',
'Special operations vehicle with equipment', 42100, '2022-11-20', 18000000.00,
'Mercedes-Benz Nigeria', NULL, '2023-11-20', '2024-05-20', '2024-11-20',
'DSS-2022-007', '2023-11-19', '2023-11-19', 'active'),

-- Vehicle 8: Mobile Police Armored Vehicle
('Ford', 'F-350 Armored', 'MOPOL-008-2020', 2020, 2020, 'truck', 'diesel',
'6.7L-V8-4567890', '1FT8W3BT5LEA123463', 'MOPOL-008-NG', '1FT8W3BT5LEA123463',
'TRK-MOPOL-008', '860123456789019', 'active', 8, 1, 'serviceable',
'Armored personnel carrier, riot control', 95200, '2020-12-05', 25000000.00,
'Ford Defense Contractor', '2020-12-05', '2021-12-05', '2024-06-05', '2024-12-05',
'MOPOL-2020-008', '2021-12-04', '2021-12-04', 'active'),

-- Vehicle 9: State Police Command Vehicle
('Land Rover', 'Defender 110', 'SPC-009-2023', 2023, 2023, 'car', 'diesel',
'300TDI-5678901', 'SALLDHMF8MA123464', 'SPC-009-NG', 'SALLDHMF8MA123464',
'TRK-SPC-009', '860123456789020', 'active', 1, 5, 'serviceable',
'Command vehicle, off-road capable', 25600, '2023-04-10', 16000000.00,
'Land Rover Nigeria', NULL, '2024-04-10', '2024-07-10', '2024-10-10',
'SPC-2023-009', '2024-04-09', '2024-04-09', 'active'),

-- Vehicle 10: FRSC Rescue Ambulance
('Mercedes-Benz', 'Vito Ambulance', 'FRSC-010-2021', 2021, 2021, 'van', 'diesel',
'OM651-6789012', 'WDF44770313123465', 'FRSC-010-NG', 'WDF44770313123465',
'TRK-FRSC-010', '860123456789021', 'active', 2, 4, 'serviceable',
'Emergency rescue ambulance, fully equipped', 89300, '2021-08-25', 22000000.00,
'Mercedes-Benz Medical', '2021-08-25', '2022-08-25', '2024-05-25', '2024-11-25',
'FRSC-2021-010', '2022-08-24', '2022-08-24', 'active');

-- ==================================================
-- MAINTENANCE SCHEDULES FOR ALL 10 VEHICLES
-- ==================================================

INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description, scheduled_date,
    mileage_due, status, priority, estimated_cost, actual_cost, service_provider,
    work_order_number, parts_replaced, labor_hours, notes, completed_date,
    next_service_date, authorized_by, performed_by
) VALUES

-- VEHICLE 1 (Toyota Camry) - Maintenance Schedules
(1, 'scheduled', 'Oil Change', 'Regular oil and filter change - 5000km service', '2024-02-15', 5000, 'completed', 'normal', 25000, 23500, 'Toyota Service Center', 'WO-2024-001', 'Engine oil, oil filter', 1.5, 'Routine maintenance completed', '2024-02-15', '2024-07-15', 1, 'Technician James'),
(1, 'scheduled', 'Major Service', '10000km comprehensive service', '2024-05-15', 10000, 'completed', 'normal', 85000, 82000, 'Toyota Service Center', 'WO-2024-002', 'Air filter, spark plugs, brake pads', 4.0, 'All systems checked', '2024-05-15', '2024-10-15', 1, 'Technician James'),
(1, 'scheduled', 'Oil Change', '15000km oil service', '2024-08-15', 15000, 'completed', 'normal', 25000, 25000, 'Toyota Service Center', 'WO-2024-003', 'Engine oil, oil filter', 1.5, 'Regular service', '2024-08-15', '2025-01-15', 1, 'Technician Mary'),
(1, 'scheduled', 'Minor Service', '20000km service due', '2025-02-15', 20000, 'scheduled', 'normal', 45000, NULL, 'Toyota Service Center', NULL, NULL, NULL, 'Upcoming service', NULL, '2025-07-15', 1, NULL),

-- VEHICLE 2 (Toyota Hilux) - Maintenance Schedules  
(2, 'scheduled', 'Oil Change', 'Diesel engine oil change - 5000km', '2023-05-20', 5000, 'completed', 'normal', 35000, 33000, 'Toyota Service Center', 'WO-2023-001', 'Diesel engine oil, oil filter', 2.0, 'Diesel service completed', '2023-05-20', '2023-08-20', 1, 'Technician Paul'),
(2, 'unscheduled', 'Tire Replacement', 'Front tire damage from highway debris', '2023-07-10', 12000, 'completed', 'high', 120000, 115000, 'Michelin Tire Center', 'WO-2023-002', 'Two front tires', 3.0, 'Emergency tire replacement', '2023-07-10', NULL, 1, 'Tire Specialist'),
(2, 'scheduled', 'Major Service', '15000km comprehensive service', '2023-11-20', 15000, 'completed', 'normal', 150000, 145000, 'Toyota Service Center', 'WO-2023-003', 'Air filter, fuel filter, brake fluid', 5.0, 'Full service completed', '2023-11-20', '2024-02-20', 1, 'Senior Technician'),
(2, 'scheduled', 'Oil Change', '20000km oil service', '2024-02-20', 20000, 'completed', 'normal', 35000, 35000, 'Toyota Service Center', 'WO-2024-004', 'Diesel engine oil, oil filter', 2.0, 'Regular maintenance', '2024-02-20', '2024-05-20', 1, 'Technician Paul'),
(2, 'scheduled', 'Major Service', '25000km service', '2024-05-20', 25000, 'completed', 'normal', 180000, 175000, 'Toyota Service Center', 'WO-2024-005', 'Timing belt, water pump, coolant', 6.0, 'Major service completed', '2024-05-20', '2024-08-20', 1, 'Master Technician'),
(2, 'scheduled', 'Oil Change', '30000km oil service', '2024-08-20', 30000, 'completed', 'normal', 35000, 35000, 'Toyota Service Center', 'WO-2024-006', 'Diesel engine oil, oil filter', 2.0, 'Routine service', '2024-08-20', '2024-11-20', 1, 'Technician Paul'),
(2, 'scheduled', 'Minor Service', '35000km service due', '2024-11-20', 35000, 'scheduled', 'normal', 95000, NULL, 'Toyota Service Center', NULL, NULL, NULL, 'Upcoming service', NULL, '2025-02-20', 1, NULL),

-- VEHICLE 3 (Hyundai Bus) - Maintenance Schedules
(3, 'overhaul', 'Annual Overhaul', 'Complete vehicle overhaul - 12 months', '2023-06-10', 50000, 'completed', 'high', 800000, 750000, 'Hyundai Service Center', 'WO-2023-007', 'Engine overhaul, transmission service, brake system', 40.0, 'Annual overhaul completed', '2023-06-15', '2024-06-10', 1, 'Overhaul Team'),
(3, 'scheduled', 'Oil Change', 'Engine oil change - bus service', '2023-09-10', 55000, 'completed', 'normal', 45000, 42000, 'Hyundai Service Center', 'WO-2023-008', 'Heavy duty engine oil, oil filter', 2.5, 'Bus oil service', '2023-09-10', '2023-12-10', 1, 'Bus Technician'),
(3, 'unscheduled', 'Air Conditioning Repair', 'AC system malfunction', '2023-11-05', 58000, 'completed', 'normal', 85000, 80000, 'Auto AC Specialist', 'WO-2023-009', 'AC compressor, refrigerant', 6.0, 'AC system repaired', '2023-11-05', NULL, 1, 'AC Technician'),
(3, 'scheduled', 'Oil Change', 'Regular oil service', '2023-12-10', 60000, 'completed', 'normal', 45000, 45000, 'Hyundai Service Center', 'WO-2023-010', 'Heavy duty engine oil, oil filter', 2.5, 'Regular service', '2023-12-10', '2024-03-10', 1, 'Bus Technician'),
(3, 'scheduled', 'Major Service', 'Comprehensive bus service', '2024-03-10', 65000, 'completed', 'normal', 200000, 195000, 'Hyundai Service Center', 'WO-2024-007', 'Brake pads, suspension check, steering alignment', 8.0, 'Major service completed', '2024-03-10', '2024-06-10', 1, 'Senior Bus Technician'),
(3, 'scheduled', 'Annual Overhaul', 'Second year overhaul', '2024-06-10', 70000, 'in_progress', 'high', 850000, NULL, 'Hyundai Service Center', 'WO-2024-008', NULL, NULL, 'Overhaul in progress', NULL, '2025-06-10', 1, 'Overhaul Team'),

-- VEHICLE 4 (Honda Motorcycle) - Maintenance Schedules
(4, 'scheduled', 'First Service', 'Initial 1000km service', '2024-05-15', 1000, 'completed', 'normal', 15000, 14000, 'Honda Service Center', 'WO-2024-009', 'Engine oil, chain adjustment', 1.0, 'First service completed', '2024-05-15', '2024-08-15', 1, 'Bike Mechanic'),
(4, 'scheduled', 'Oil Change', '3000km oil service', '2024-08-01', 3000, 'completed', 'normal', 8000, 8000, 'Honda Service Center', 'WO-2024-010', 'Motorcycle engine oil', 0.5, 'Oil change completed', '2024-08-01', '2024-11-01', 1, 'Bike Mechanic'),
(4, 'scheduled', 'Minor Service', '5000km service due', '2024-11-01', 5000, 'scheduled', 'normal', 25000, NULL, 'Honda Service Center', NULL, NULL, NULL, 'Upcoming service', NULL, '2025-02-01', 1, NULL),

-- VEHICLE 5 (Ford Transit) - Maintenance Schedules
(5, 'scheduled', 'Oil Change', 'Van oil service - 5000km', '2023-09-15', 5000, 'completed', 'normal', 40000, 38000, 'Ford Service Center', 'WO-2023-011', 'Van engine oil, oil filter', 2.0, 'Van service completed', '2023-09-15', '2023-12-15', 1, 'Van Technician'),
(5, 'scheduled', 'Major Service', '10000km comprehensive service', '2023-12-15', 10000, 'completed', 'normal', 120000, 115000, 'Ford Service Center', 'WO-2023-012', 'Air filter, brake inspection, cooling system', 4.5, 'Major service done', '2023-12-15', '2024-03-15', 1, 'Senior Van Tech'),
(5, 'scheduled', 'Oil Change', '15000km oil service', '2024-03-15', 15000, 'completed', 'normal', 40000, 40000, 'Ford Service Center', 'WO-2024-011', 'Van engine oil, oil filter', 2.0, 'Regular maintenance', '2024-03-15', '2024-06-15', 1, 'Van Technician'),
(5, 'scheduled', 'Major Service', '20000km service', '2024-06-15', 20000, 'completed', 'normal', 140000, 135000, 'Ford Service Center', 'WO-2024-012', 'Transmission service, brake pads', 5.0, 'Comprehensive service', '2024-06-15', '2024-09-15', 1, 'Master Van Tech'),
(5, 'scheduled', 'Oil Change', '25000km oil service', '2024-09-15', 25000, 'completed', 'normal', 40000, 40000, 'Ford Service Center', 'WO-2024-013', 'Van engine oil, oil filter', 2.0, 'Oil service done', '2024-09-15', '2024-12-15', 1, 'Van Technician'),
(5, 'scheduled', 'Major Service', '30000km service due', '2024-12-15', 30000, 'scheduled', 'normal', 160000, NULL, 'Ford Service Center', NULL, NULL, NULL, 'Upcoming major service', NULL, '2025-03-15', 1, NULL),

-- VEHICLE 6 (Mitsubishi Pajero) - Maintenance Schedules
(6, 'overhaul', 'Annual Overhaul', 'First year overhaul', '2022-09-30', 30000, 'completed', 'high', 600000, 580000, 'Mitsubishi Service Center', 'WO-2022-001', 'Engine overhaul, 4WD system service', 35.0, 'Annual overhaul completed', '2022-10-05', '2023-09-30', 1, 'Overhaul Specialist'),
(6, 'scheduled', 'Oil Change', '35000km oil service', '2022-12-30', 35000, 'completed', 'normal', 50000, 48000, 'Mitsubishi Service Center', 'WO-2022-002', 'SUV engine oil, oil filter', 2.5, 'Oil change completed', '2022-12-30', '2023-03-30', 1, 'SUV Technician'),
(6, 'scheduled', 'Major Service', '40000km comprehensive service', '2023-03-30', 40000, 'completed', 'normal', 180000, 175000, 'Mitsubishi Service Center', 'WO-2023-013', 'Timing belt, water pump, differential service', 7.0, 'Major service completed', '2023-03-30', '2023-06-30', 1, 'Senior SUV Tech'),
(6, 'unscheduled', 'Suspension Repair', 'Front suspension noise', '2023-05-15', 45000, 'completed', 'normal', 120000, 115000, 'Suspension Specialist', 'WO-2023-014', 'Front shock absorbers', 4.0, 'Suspension repaired', '2023-05-15', NULL, 1, 'Suspension Tech'),
(6, 'scheduled', 'Oil Change', '50000km oil service', '2023-06-30', 50000, 'completed', 'normal', 50000, 50000, 'Mitsubishi Service Center', 'WO-2023-015', 'SUV engine oil, oil filter', 2.5, 'Regular oil service', '2023-06-30', '2023-09-30', 1, 'SUV Technician'),
(6, 'overhaul', 'Second Year Overhaul', 'Second annual overhaul', '2023-09-30', 60000, 'completed', 'high', 650000, 625000, 'Mitsubishi Service Center', 'WO-2023-016', 'Engine tune-up, transmission overhaul, brake system', 40.0, 'Second overhaul completed', '2023-10-08', '2024-09-30', 1, 'Overhaul Team'),
(6, 'scheduled', 'Oil Change', '65000km oil service', '2023-12-30', 65000, 'completed', 'normal', 50000, 50000, 'Mitsubishi Service Center', 'WO-2023-017', 'SUV engine oil, oil filter', 2.5, 'Oil service done', '2023-12-30', '2024-03-30', 1, 'SUV Technician'),
(6, 'scheduled', 'Major Service', '70000km service', '2024-03-30', 70000, 'completed', 'normal', 200000, 195000, 'Mitsubishi Service Center', 'WO-2024-014', 'Brake system overhaul, AC service', 8.0, 'Major service completed', '2024-03-30', '2024-06-30', 1, 'Master SUV Tech'),
(6, 'scheduled', 'Oil Change', '75000km oil service', '2024-06-30', 75000, 'completed', 'normal', 50000, 50000, 'Mitsubishi Service Center', 'WO-2024-015', 'SUV engine oil, oil filter', 2.5, 'Regular maintenance', '2024-06-30', '2024-09-30', 1, 'SUV Technician'),
(6, 'scheduled', 'Third Year Overhaul', 'Third annual overhaul due', '2024-09-30', 80000, 'scheduled', 'high', 700000, NULL, 'Mitsubishi Service Center', NULL, NULL, NULL, 'Annual overhaul due', NULL, '2025-09-30', 1, NULL),

-- VEHICLE 7 (Mercedes Sprinter) - Maintenance Schedules
(7, 'scheduled', 'Oil Change', 'Commercial van oil service', '2023-01-20', 5000, 'completed', 'normal', 55000, 52000, 'Mercedes-Benz Service', 'WO-2023-018', 'Premium engine oil, oil filter', 2.5, 'Van oil service completed', '2023-01-20', '2023-04-20', 1, 'Mercedes Technician'),
(7, 'scheduled', 'Major Service', 'Commercial van major service', '2023-04-20', 10000, 'completed', 'normal', 200000, 195000, 'Mercedes-Benz Service', 'WO-2023-019', 'Air filter, fuel filter, brake inspection', 6.0, 'Major service completed', '2023-04-20', '2023-07-20', 1, 'Senior Mercedes Tech'),
(7, 'unscheduled', 'Electronic Repair', 'Dashboard warning lights', '2023-06-10', 15000, 'completed', 'normal', 75000, 70000, 'Mercedes Electronics', 'WO-2023-020', 'ECU diagnostics, sensor replacement', 3.0, 'Electronic issues resolved', '2023-06-10', NULL, 1, 'Electronics Specialist'),
(7, 'scheduled', 'Oil Change', 'Regular oil maintenance', '2023-07-20', 20000, 'completed', 'normal', 55000, 55000, 'Mercedes-Benz Service', 'WO-2023-021', 'Premium engine oil, oil filter', 2.5, 'Oil change done', '2023-07-20', '2023-10-20', 1, 'Mercedes Technician'),
(7, 'scheduled', 'Major Service', 'Comprehensive service', '2023-10-20', 25000, 'completed', 'normal', 220000, 215000, 'Mercedes-Benz Service', 'WO-2023-022', 'Transmission service, suspension check', 7.0, 'Major service completed', '2023-10-20', '2024-01-20', 1, 'Master Mercedes Tech'),
(7, 'scheduled', 'Annual Service', 'Annual comprehensive check', '2023-11-20', 30000, 'completed', 'high', 400000, 385000, 'Mercedes-Benz Service', 'WO-2023-023', 'Annual inspection, brake overhaul, AC service', 12.0, 'Annual service completed', '2023-11-25', '2024-11-20', 1, 'Service Manager'),
(7, 'scheduled', 'Oil Change', 'Oil service', '2024-01-20', 35000, 'completed', 'normal', 55000, 55000, 'Mercedes-Benz Service', 'WO-2024-016', 'Premium engine oil, oil filter', 2.5, 'Regular oil service', '2024-01-20', '2024-04-20', 1, 'Mercedes Technician'),
(7, 'scheduled', 'Major Service', 'Major service', '2024-04-20', 40000, 'completed', 'normal', 240000, 235000, 'Mercedes-Benz Service', 'WO-2024-017', 'Timing chain, water pump, coolant system', 8.0, 'Major service done', '2024-04-20', '2024-07-20', 1, 'Senior Mercedes Tech'),
(7, 'scheduled', 'Oil Change', 'Regular maintenance', '2024-07-20', 45000, 'completed', 'normal', 55000, 55000, 'Mercedes-Benz Service', 'WO-2024-018', 'Premium engine oil, oil filter', 2.5, 'Oil service completed', '2024-07-20', '2024-10-20', 1, 'Mercedes Technician'),
(7, 'scheduled', 'Major Service', 'Comprehensive service due', '2024-10-20', 50000, 'scheduled', 'normal', 260000, NULL, 'Mercedes-Benz Service', NULL, NULL, NULL, 'Major service upcoming', NULL, '2025-01-20', 1, NULL),

-- VEHICLE 8 (Ford F-350 Armored) - Maintenance Schedules
(8, 'overhaul', 'Major Overhaul', 'Armored vehicle overhaul', '2021-12-05', 40000, 'completed', 'critical', 1200000, 1150000, 'Ford Defense Service', 'WO-2021-001', 'Engine overhaul, armor inspection, weapon systems', 60.0, 'Major overhaul completed', '2021-12-15', '2022-12-05', 1, 'Defense Technician Team'),
(8, 'scheduled', 'Heavy Duty Service', 'Armored vehicle service', '2022-03-05', 50000, 'completed', 'high', 300000, 285000, 'Ford Defense Service', 'WO-2022-003', 'Heavy duty oil, armor check, communication systems', 8.0, 'Heavy service completed', '2022-03-05', '2022-06-05', 1, 'Defense Specialist'),
(8, 'unscheduled', 'Armor Repair', 'Minor armor panel damage', '2022-05-20', 55000, 'completed', 'high', 450000, 425000, 'Armor Specialist', 'WO-2022-004', 'Armor panel, ballistic glass', 20.0, 'Armor repaired', '2022-05-20', NULL, 1, 'Armor Technician'),
(8, 'scheduled', 'Heavy Duty Service', 'Regular heavy service', '2022-06-05', 60000, 'completed', 'high', 320000, 315000, 'Ford Defense Service', 'WO-2022-005', 'Engine service, brake system, suspension', 10.0, 'Service completed', '2022-06-05', '2022-09-05', 1, 'Defense Specialist'),
(8, 'scheduled', 'Heavy Duty Service', 'Quarterly service', '2022-09-05', 70000, 'completed', 'high', 340000, 335000, 'Ford Defense Service', 'WO-2022-006', 'Transmission service, differential, cooling system', 12.0, 'Quarterly service done', '2022-09-05', '2022-12-05', 1, 'Senior Defense Tech'),
(8, 'overhaul', 'Annual Overhaul', 'Second year overhaul', '2022-12-05', 80000, 'completed', 'critical', 1300000, 1250000, 'Ford Defense Service', 'WO-2022-007', 'Complete overhaul, armor certification, systems upgrade', 65.0, 'Annual overhaul completed', '2022-12-20', '2023-12-05', 1, 'Overhaul Team'),
(8, 'scheduled', 'Heavy Duty Service', 'Post-overhaul service', '2023-03-05', 85000, 'completed', 'high', 350000, 345000, 'Ford Defense Service', 'WO-2023-024', 'Post-overhaul inspection, fluids, systems check', 8.0, 'Post-overhaul service', '2023-03-05', '2023-06-05', 1, 'Defense Specialist'),
(8, 'scheduled', 'Heavy Duty Service', 'Regular service', '2023-06-05', 90000, 'completed', 'high', 360000, 355000, 'Ford Defense Service', 'WO-2023-025', 'Engine maintenance, brake inspection', 10.0, 'Regular service completed', '2023-06-05', '2023-09-05', 1, 'Defense Specialist'),
(8, 'scheduled', 'Heavy Duty Service', 'Quarterly service', '2023-09-05', 95000, 'completed', 'high', 370000, 365000, 'Ford Defense Service', 'WO-2023-026', 'Suspension, steering, communication systems', 12.0, 'Service completed', '2023-09-05', '2023-12-05', 1, 'Senior Defense Tech'),
(8, 'overhaul', 'Third Year Overhaul', 'Annual overhaul', '2023-12-05', 100000, 'completed', 'critical', 1400000, 1350000, 'Ford Defense Service', 'WO-2023-027', 'Major overhaul, armor recertification', 70.0, 'Third overhaul completed', '2023-12-25', '2024-12-05', 1, 'Overhaul Team'),
(8, 'scheduled', 'Heavy Duty Service', 'Current service due', '2024-12-05', 105000, 'scheduled', 'critical', 1500000, NULL, 'Ford Defense Service', NULL, NULL, NULL, 'Fourth year overhaul due', NULL, '2025-12-05', 1, NULL),

-- VEHICLE 9 (Land Rover Defender) - Maintenance Schedules
(9, 'scheduled', 'Oil Change', 'Land Rover oil service', '2023-06-10', 5000, 'completed', 'normal', 60000, 58000, 'Land Rover Service', 'WO-2023-028', 'Premium engine oil, oil filter', 3.0, 'Oil service completed', '2023-06-10', '2023-09-10', 1, 'Land Rover Technician'),
(9, 'scheduled', 'Major Service', 'Off-road vehicle service', '2023-09-10', 10000, 'completed', 'normal', 250000, 245000, 'Land Rover Service', 'WO-2023-029', 'Differential service, transfer case, air filter', 8.0, 'Major service completed', '2023-09-10', '2023-12-10', 1, 'Off-road Specialist'),
(9, 'unscheduled', 'Suspension Upgrade', 'Heavy duty suspension for rough terrain', '2023-11-15', 15000, 'completed', 'normal', 180000, 175000, 'Suspension Specialist', 'WO-2023-030', 'Heavy duty shock absorbers, springs', 6.0, 'Suspension upgraded', '2023-11-15', NULL, 1, 'Suspension Expert'),
(9, 'scheduled', 'Oil Change', 'Regular oil maintenance', '2023-12-10', 20000, 'completed', 'normal', 60000, 60000, 'Land Rover Service', 'WO-2023-031', 'Premium engine oil, oil filter', 3.0, 'Oil change done', '2023-12-10', '2024-03-10', 1, 'Land Rover Technician'),
(9, 'scheduled', 'Major Service', 'Comprehensive service', '2024-03-10', 25000, 'completed', 'normal', 280000, 275000, 'Land Rover Service', 'WO-2024-019', 'Brake system, steering, electrical check', 10.0, 'Major service done', '2024-03-10', '2024-06-10', 1, 'Senior Land Rover Tech'),
(9, 'scheduled', 'Annual Service', 'Annual inspection', '2024-04-10', 26000, 'completed', 'high', 500000, 485000, 'Land Rover Service', 'WO-2024-020', 'Annual inspection, timing belt, water pump', 15.0, 'Annual service completed', '2024-04-15', '2025-04-10', 1, 'Service Manager'),
(9, 'scheduled', 'Oil Change', 'Regular maintenance', '2024-06-10', 30000, 'completed', 'normal', 60000, 60000, 'Land Rover Service', 'WO-2024-021', 'Premium engine oil, oil filter', 3.0, 'Oil service done', '2024-06-10', '2024-09-10', 1, 'Land Rover Technician'),
(9, 'scheduled', 'Major Service', 'Comprehensive service due', '2024-09-10', 35000, 'scheduled', 'normal', 300000, NULL, 'Land Rover Service', NULL, NULL, NULL, 'Major service upcoming', NULL, '2024-12-10', 1, NULL),

-- VEHICLE 10 (Mercedes Ambulance) - Maintenance Schedules
(10, 'overhaul', 'Medical Equipment Overhaul', 'Annual medical equipment service', '2022-08-25', 30000, 'completed', 'critical', 800000, 775000, 'Mercedes Medical Service', 'WO-2022-008', 'Medical equipment calibration, ambulance systems', 35.0, 'Medical overhaul completed', '2022-09-05', '2023-08-25', 1, 'Medical Equipment Team'),
(10, 'scheduled', 'Ambulance Service', 'Specialized ambulance service', '2022-11-25', 35000, 'completed', 'high', 180000, 175000, 'Mercedes Medical Service', 'WO-2022-009', 'Engine service, medical oxygen systems', 6.0, 'Ambulance service completed', '2022-11-25', '2023-02-25', 1, 'Ambulance Technician'),
(10, 'unscheduled', 'Siren Repair', 'Emergency siren malfunction', '2023-01-10', 40000, 'completed', 'critical', 25000, 22000, 'Emergency Equipment', 'WO-2023-032', 'Emergency siren system', 2.0, 'Siren repaired', '2023-01-10', NULL, 1, 'Electronics Tech'),
(10, 'scheduled', 'Ambulance Service', 'Regular ambulance maintenance', '2023-02-25', 45000, 'completed', 'high', 200000, 195000, 'Mercedes Medical Service', 'WO-2023-033', 'Brake system, suspension, medical equipment check', 8.0, 'Service completed', '2023-02-25', '2023-05-25', 1, 'Senior Ambulance Tech'),
(10, 'scheduled', 'Medical Equipment Service', 'Quarterly medical check', '2023-05-25', 50000, 'completed', 'critical', 150000, 145000, 'Medical Equipment Service', 'WO-2023-034', 'Defibrillator, ventilator, monitoring equipment', 4.0, 'Medical equipment serviced', '2023-05-25', '2023-08-25', 1, 'Medical Tech'),
(10, 'overhaul', 'Annual Medical Overhaul', 'Second year medical overhaul', '2023-08-25', 60000, 'completed', 'critical', 850000, 825000, 'Mercedes Medical Service', 'WO-2023-035', 'Complete medical systems overhaul, certification', 40.0, 'Annual overhaul completed', '2023-09-10', '2024-08-25', 1, 'Medical Overhaul Team'),
(10, 'scheduled', 'Ambulance Service', 'Post-overhaul service', '2023-11-25', 65000, 'completed', 'high', 220000, 215000, 'Mercedes Medical Service', 'WO-2023-036', 'Post-overhaul inspection, fluids, systems', 8.0, 'Post-overhaul service', '2023-11-25', '2024-02-25', 1, 'Ambulance Technician'),
(10, 'scheduled', 'Ambulance Service', 'Regular maintenance', '2024-02-25', 70000, 'completed', 'high', 240000, 235000, 'Mercedes Medical Service', 'WO-2024-022', 'Engine maintenance, transmission, medical systems', 10.0, 'Regular service completed', '2024-02-25', '2024-05-25', 1, 'Senior Ambulance Tech'),
(10, 'scheduled', 'Medical Equipment Service', 'Medical equipment check', '2024-05-25', 75000, 'completed', 'critical', 160000, 155000, 'Medical Equipment Service', 'WO-2024-023', 'Medical equipment calibration, battery replacement', 5.0, 'Medical service completed', '2024-05-25', '2024-08-25', 1, 'Medical Tech'),
(10, 'overhaul', 'Third Year Medical Overhaul', 'Annual medical overhaul due', '2024-08-25', 80000, 'scheduled', 'critical', 900000, NULL, 'Mercedes Medical Service', NULL, NULL, NULL, 'Annual medical overhaul due', NULL, '2025-08-25', 1, NULL);

-- ==================================================
-- MAINTENANCE HISTORY FOR ALL 10 VEHICLES
-- ==================================================

INSERT INTO maintenance_history (
    vehicle_id, maintenance_schedule_id, maintenance_date, maintenance_category,
    work_performed, parts_used, cost, mileage_at_service, service_provider,
    technician_name, before_condition, after_condition, warranty_period, created_by
) VALUES

-- VEHICLE 1 (Toyota Camry) - History Records
(1, 1, '2024-02-15', 'scheduled', 'Changed engine oil and oil filter, checked all fluid levels', 'Engine oil 4L, Oil filter', 23500, 5000, 'Toyota Service Center', 'Technician James', 'Due for oil change', 'Fresh oil, good condition', 6, 1),
(1, 2, '2024-05-15', 'scheduled', 'Comprehensive 10000km service - replaced air filter, spark plugs, brake pads', 'Air filter, Spark plugs x4, Front brake pads', 82000, 10000, 'Toyota Service Center', 'Technician James', 'Minor wear on brake pads', 'All components replaced, excellent condition', 12, 1),
(1, 3, '2024-08-15', 'scheduled', 'Regular oil and filter change, topped up fluids', 'Engine oil 4L, Oil filter', 25000, 15000, 'Toyota Service Center', 'Technician Mary', 'Regular maintenance due', 'Oil changed, all systems good', 6, 1),

-- VEHICLE 2 (Toyota Hilux) - History Records  
(2, 5, '2023-05-20', 'scheduled', 'Diesel engine oil change and filter replacement', 'Diesel engine oil 6L, Oil filter', 33000, 5000, 'Toyota Service Center', 'Technician Paul', 'Oil change due', 'Fresh diesel oil, filter replaced', 6, 1),
(2, 6, '2023-07-10', 'unscheduled', 'Emergency tire replacement due to highway debris damage', 'Michelin tires x2', 115000, 12000, 'Michelin Tire Center', 'Tire Specialist', 'Front tires damaged', 'New tires installed, alignment checked', 24, 1),
(2, 7, '2023-11-20', 'scheduled', 'Major 15000km service - air filter, fuel filter, brake fluid replacement', 'Air filter, Fuel filter, Brake fluid', 145000, 15000, 'Toyota Service Center', 'Senior Technician', 'Regular service due', 'All filters replaced, brake system serviced', 12, 1),
(2, 8, '2024-02-20', 'scheduled', 'Regular diesel oil and filter change', 'Diesel engine oil 6L, Oil filter', 35000, 20000, 'Toyota Service Center', 'Technician Paul', 'Oil change due', 'Fresh oil and filter', 6, 1),
(2, 9, '2024-05-20', 'scheduled', 'Major service including timing belt and water pump replacement', 'Timing belt, Water pump, Coolant', 175000, 25000, 'Toyota Service Center', 'Master Technician', 'Timing belt at service interval', 'Major components replaced, cooling system flushed', 24, 1),
(2, 10, '2024-08-20', 'scheduled', 'Regular oil change and basic inspection', 'Diesel engine oil 6L, Oil filter', 35000, 30000, 'Toyota Service Center', 'Technician Paul', 'Routine maintenance', 'Oil changed, all systems checked', 6, 1),

-- VEHICLE 3 (Hyundai Bus) - History Records
(3, 13, '2023-06-15', 'overhaul', 'Complete annual overhaul including engine, transmission, and brake system', 'Engine overhaul kit, Transmission oil, Brake pads and discs', 750000, 50000, 'Hyundai Service Center', 'Overhaul Team', 'Annual overhaul due', 'Complete overhaul, certified for service', 12, 1),
(3, 14, '2023-09-10', 'scheduled', 'Heavy duty oil change for bus operations', 'Heavy duty engine oil 8L, Oil filter', 42000, 55000, 'Hyundai Service Center', 'Bus Technician', 'Oil change due', 'Fresh heavy duty oil installed', 6, 1),
(3, 15, '2023-11-05', 'unscheduled', 'Air conditioning system repair - compressor and refrigerant', 'AC compressor, Refrigerant', 80000, 58000, 'Auto AC Specialist', 'AC Technician', 'AC not cooling properly', 'AC system fully operational', 12, 1),
(3, 16, '2023-12-10', 'scheduled', 'Regular bus oil service and inspection', 'Heavy duty engine oil 8L, Oil filter', 45000, 60000, 'Hyundai Service Center', 'Bus Technician', 'Scheduled maintenance', 'Oil changed, bus ready for service', 6, 1),
(3, 17, '2024-03-10', 'scheduled', 'Major bus service including brakes and suspension', 'Brake pads, Suspension components', 195000, 65000, 'Hyundai Service Center', 'Senior Bus Technician', 'Major service due', 'Brakes and suspension serviced', 12, 1),

-- VEHICLE 4 (Honda Motorcycle) - History Records
(4, 22, '2024-05-15', 'scheduled', 'First service for new motorcycle - oil change and chain adjustment', 'Motorcycle oil 1L, Chain lubricant', 14000, 1000, 'Honda Service Center', 'Bike Mechanic', 'New motorcycle first service', 'First service completed, bike ready', 6, 1),
(4, 23, '2024-08-01', 'scheduled', 'Regular oil change for motorcycle', 'Motorcycle oil 1L', 8000, 3000, 'Honda Service Center', 'Bike Mechanic', 'Oil change due', 'Fresh oil, good condition', 6, 1),

-- VEHICLE 5 (Ford Transit) - History Records
(5, 25, '2023-09-15', 'scheduled', 'Van oil service and basic maintenance', 'Van engine oil 5L, Oil filter', 38000, 5000, 'Ford Service Center', 'Van Technician', 'Oil change due', 'Oil changed, van serviced', 6, 1),
(5, 26, '2023-12-15', 'scheduled', 'Comprehensive van service - air filter, brakes, cooling system', 'Air filter, Brake inspection, Coolant', 115000, 10000, 'Ford Service Center', 'Senior Van Tech', 'Major service due', 'All systems serviced and checked', 12, 1),
(5, 27, '2024-03-15', 'scheduled', 'Regular van oil change and inspection', 'Van engine oil 5L, Oil filter', 40000, 15000, 'Ford Service Center', 'Van Technician', 'Routine maintenance', 'Oil changed, systems good', 6, 1),
(5, 28, '2024-06-15', 'scheduled', 'Major van service including transmission and brakes', 'Transmission oil, Brake pads', 135000, 20000, 'Ford Service Center', 'Master Van Tech', 'Major service interval', 'Transmission and brakes serviced', 12, 1),
(5, 29, '2024-09-15', 'scheduled', 'Regular oil service for van', 'Van engine oil 5L, Oil filter', 40000, 25000, 'Ford Service Center', 'Van Technician', 'Oil change due', 'Oil changed, good condition', 6, 1),

-- VEHICLE 6 (Mitsubishi Pajero) - History Records
(6, 31, '2022-10-05', 'overhaul', 'First annual overhaul including engine and 4WD system', 'Engine overhaul kit, 4WD system service', 580000, 30000, 'Mitsubishi Service Center', 'Overhaul Specialist', 'Annual overhaul due', 'Complete overhaul, 4WD certified', 12, 1),
(6, 32, '2022-12-30', 'scheduled', 'SUV oil change and inspection', 'SUV engine oil 5L, Oil filter', 48000, 35000, 'Mitsubishi Service Center', 'SUV Technician', 'Oil change due', 'Fresh oil, good condition', 6, 1),
(6, 33, '2023-03-30', 'scheduled', 'Major SUV service - timing belt, water pump, differential', 'Timing belt, Water pump, Differential oil', 175000, 40000, 'Mitsubishi Service Center', 'Senior SUV Tech', 'Major service interval', 'Major components replaced', 24, 1),
(6, 34, '2023-05-15', 'unscheduled', 'Front suspension repair due to noise', 'Front shock absorbers x2', 115000, 45000, 'Suspension Specialist', 'Suspension Tech', 'Suspension noise reported', 'Suspension repaired, noise eliminated', 12, 1),
(6, 35, '2023-06-30', 'scheduled', 'Regular SUV oil service', 'SUV engine oil 5L, Oil filter', 50000, 50000, 'Mitsubishi Service Center', 'SUV Technician', 'Routine oil change', 'Oil changed, ready for service', 6, 1),
(6, 36, '2023-10-08', 'overhaul', 'Second annual overhaul - engine tune-up and transmission', 'Engine tune-up kit, Transmission overhaul', 625000, 60000, 'Mitsubishi Service Center', 'Overhaul Team', 'Second year overhaul', 'Complete overhaul, certified', 12, 1),
(6, 37, '2023-12-30', 'scheduled', 'Post-overhaul oil service', 'SUV engine oil 5L, Oil filter', 50000, 65000, 'Mitsubishi Service Center', 'SUV Technician', 'Post-overhaul service', 'Oil changed, systems checked', 6, 1),
(6, 38, '2024-03-30', 'scheduled', 'Major SUV service - brake system and AC', 'Brake system overhaul, AC service', 195000, 70000, 'Mitsubishi Service Center', 'Master SUV Tech', 'Major service due', 'Brake system and AC serviced', 12, 1),
(6, 39, '2024-06-30', 'scheduled', 'Regular oil maintenance for SUV', 'SUV engine oil 5L, Oil filter', 50000, 75000, 'Mitsubishi Service Center', 'SUV Technician', 'Routine maintenance', 'Oil changed, good condition', 6, 1),

-- VEHICLE 7 (Mercedes Sprinter) - History Records
(7, 41, '2023-01-20', 'scheduled', 'Commercial van premium oil service', 'Premium engine oil 6L, Oil filter', 52000, 5000, 'Mercedes-Benz Service', 'Mercedes Technician', 'Oil service due', 'Premium oil installed', 6, 1),
(7, 42, '2023-04-20', 'scheduled', 'Major commercial van service - comprehensive check', 'Air filter, Fuel filter, Brake inspection', 195000, 10000, 'Mercedes-Benz Service', 'Senior Mercedes Tech', 'Major service interval', 'All systems serviced', 12, 1),
(7, 43, '2023-06-10', 'unscheduled', 'Electronic system diagnostics and repair', 'ECU diagnostics, Sensors', 70000, 15000, 'Mercedes Electronics', 'Electronics Specialist', 'Dashboard warning lights', 'Electronic issues resolved', 12, 1),
(7, 44, '2023-07-20', 'scheduled', 'Regular premium oil service', 'Premium engine oil 6L, Oil filter', 55000, 20000, 'Mercedes-Benz Service', 'Mercedes Technician', 'Oil change due', 'Fresh premium oil', 6, 1),
(7, 45, '2023-10-20', 'scheduled', 'Major service - transmission and suspension', 'Transmission service, Suspension check', 215000, 25000, 'Mercedes-Benz Service', 'Master Mercedes Tech', 'Major service due', 'Transmission and suspension serviced', 12, 1),
(7, 46, '2023-11-25', 'scheduled', 'Annual comprehensive service and inspection', 'Annual inspection kit, Brake overhaul, AC service', 385000, 30000, 'Mercedes-Benz Service', 'Service Manager', 'Annual service due', 'Complete annual service', 12, 1),
(7, 47, '2024-01-20', 'scheduled', 'Regular oil service', 'Premium engine oil 6L, Oil filter', 55000, 35000, 'Mercedes-Benz Service', 'Mercedes Technician', 'Oil service due', 'Oil changed, good condition', 6, 1),
(7, 48, '2024-04-20', 'scheduled', 'Major service - timing chain and cooling system', 'Timing chain, Water pump, Coolant', 235000, 40000, 'Mercedes-Benz Service', 'Senior Mercedes Tech', 'Major service interval', 'Major components replaced', 24, 1),
(7, 49, '2024-07-20', 'scheduled', 'Regular maintenance oil service', 'Premium engine oil 6L, Oil filter', 55000, 45000, 'Mercedes-Benz Service', 'Mercedes Technician', 'Routine oil change', 'Oil changed, ready for service', 6, 1),

-- VEHICLE 8 (Ford F-350 Armored) - History Records
(8, 51, '2021-12-15', 'overhaul', 'Major armored vehicle overhaul - complete system check', 'Engine overhaul, Armor inspection, Weapon systems check', 1150000, 40000, 'Ford Defense Service', 'Defense Technician Team', 'Annual overhaul due', 'Complete overhaul, certified for service', 12, 1),
(8, 52, '2022-03-05', 'scheduled', 'Heavy duty armored vehicle service', 'Heavy duty oil, Armor components, Communication systems', 285000, 50000, 'Ford Defense Service', 'Defense Specialist', 'Heavy service due', 'All systems serviced and tested', 6, 1),
(8, 53, '2022-05-20', 'unscheduled', 'Armor panel repair due to minor damage', 'Armor panel, Ballistic glass', 425000, 55000, 'Armor Specialist', 'Armor Technician', 'Minor armor damage', 'Armor repaired, ballistic integrity restored', 24, 1),
(8, 54, '2022-06-05', 'scheduled', 'Regular heavy duty service for armored vehicle', 'Engine service kit, Brake system, Suspension components', 315000, 60000, 'Ford Defense Service', 'Defense Specialist', 'Regular service interval', 'Engine, brakes, and suspension serviced', 6, 1),
(8, 55, '2022-09-05', 'scheduled', 'Quarterly heavy service - transmission and differential', 'Transmission service, Differential service, Cooling system', 335000, 70000, 'Ford Defense Service', 'Senior Defense Tech', 'Quarterly service due', 'Drivetrain and cooling serviced', 6, 1),
(8, 56, '2022-12-20', 'overhaul', 'Second year complete overhaul with systems upgrade', 'Complete overhaul kit, Armor certification, Systems upgrade', 1250000, 80000, 'Ford Defense Service', 'Overhaul Team', 'Annual overhaul due', 'Complete overhaul with upgrades', 12, 1),
(8, 57, '2023-03-05', 'scheduled', 'Post-overhaul inspection and service', 'Fluids, Filters, Systems check', 345000, 85000, 'Ford Defense Service', 'Defense Specialist', 'Post-overhaul service', 'All systems checked post-overhaul', 6, 1),
(8, 58, '2023-06-05', 'scheduled', 'Regular heavy duty maintenance', 'Engine maintenance kit, Brake inspection', 355000, 90000, 'Ford Defense Service', 'Defense Specialist', 'Regular service due', 'Engine and brakes serviced', 6, 1),
(8, 59, '2023-09-05', 'scheduled', 'Quarterly service - suspension and communication', 'Suspension service, Communication systems check', 365000, 95000, 'Ford Defense Service', 'Senior Defense Tech', 'Quarterly service', 'Suspension and comms serviced', 6, 1),
(8, 60, '2023-12-25', 'overhaul', 'Third year major overhaul with armor recertification', 'Major overhaul kit, Armor recertification', 1350000, 100000, 'Ford Defense Service', 'Overhaul Team', 'Annual overhaul due', 'Major overhaul, armor recertified', 12, 1),

-- VEHICLE 9 (Land Rover Defender) - History Records
(9, 62, '2023-06-10', 'scheduled', 'Land Rover premium oil service', 'Premium engine oil 5L, Oil filter', 58000, 5000, 'Land Rover Service', 'Land Rover Technician', 'Oil service due', 'Premium oil installed', 6, 1),
(9, 63, '2023-09-10', 'scheduled', 'Off-road vehicle major service', 'Differential service, Transfer case, Air filter', 245000, 10000, 'Land Rover Service', 'Off-road Specialist', 'Major service due', 'Off-road systems serviced', 12, 1),
(9, 64, '2023-11-15', 'unscheduled', 'Heavy duty suspension upgrade for rough terrain', 'Heavy duty shock absorbers, Springs', 175000, 15000, 'Suspension Specialist', 'Suspension Expert', 'Suspension upgrade needed', 'Heavy duty suspension installed', 24, 1),
(9, 65, '2023-12-10', 'scheduled', 'Regular oil maintenance', 'Premium engine oil 5L, Oil filter', 60000, 20000, 'Land Rover Service', 'Land Rover Technician', 'Oil change due', 'Oil changed, good condition', 6, 1),
(9, 66, '2024-03-10', 'scheduled', 'Comprehensive service - brakes, steering, electrical', 'Brake system service, Steering components, Electrical check', 275000, 25000, 'Land Rover Service', 'Senior Land Rover Tech', 'Major service interval', 'All major systems serviced', 12, 1),
(9, 67, '2024-04-15', 'scheduled', 'Annual inspection and major service', 'Annual inspection kit, Timing belt, Water pump', 485000, 26000, 'Land Rover Service', 'Service Manager', 'Annual service due', 'Complete annual service', 12, 1),
(9, 68, '2024-06-10', 'scheduled', 'Regular maintenance oil service', 'Premium engine oil 5L, Oil filter', 60000, 30000, 'Land Rover Service', 'Land Rover Technician', 'Oil service due', 'Oil changed, ready for service', 6, 1),

-- VEHICLE 10 (Mercedes Ambulance) - History Records
(10, 70, '2022-09-05', 'overhaul', 'Medical equipment annual overhaul and calibration', 'Medical equipment calibration, Ambulance systems upgrade', 775000, 30000, 'Mercedes Medical Service', 'Medical Equipment Team', 'Annual medical overhaul', 'All medical equipment calibrated', 12, 1),
(10, 71, '2022-11-25', 'scheduled', 'Specialized ambulance service with medical systems check', 'Engine service, Medical oxygen systems', 175000, 35000, 'Mercedes Medical Service', 'Ambulance Technician', 'Ambulance service due', 'Engine and medical systems serviced', 6, 1),
(10, 72, '2023-01-10', 'unscheduled', 'Emergency siren system repair', 'Emergency siren system', 22000, 40000, 'Emergency Equipment', 'Electronics Tech', 'Siren malfunction', 'Siren system repaired and tested', 12, 1),
(10, 73, '2023-02-25', 'scheduled', 'Regular ambulance maintenance with medical equipment check', 'Brake system, Suspension, Medical equipment check', 195000, 45000, 'Mercedes Medical Service', 'Senior Ambulance Tech', 'Regular service due', 'Vehicle and medical equipment serviced', 6, 1),
(10, 74, '2023-05-25', 'scheduled', 'Quarterly medical equipment service and calibration', 'Defibrillator service, Ventilator check, Monitoring equipment', 145000, 50000, 'Medical Equipment Service', 'Medical Tech', 'Medical equipment service', 'All medical equipment calibrated', 3, 1),
(10, 75, '2023-09-10', 'overhaul', 'Second year complete medical overhaul with certification', 'Complete medical systems overhaul, Certification', 825000, 60000, 'Mercedes Medical Service', 'Medical Overhaul Team', 'Annual medical overhaul', 'Complete medical overhaul certified', 12, 1),
(10, 76, '2023-11-25', 'scheduled', 'Post-overhaul ambulance service', 'Post-overhaul inspection, Fluids, Systems check', 215000, 65000, 'Mercedes Medical Service', 'Ambulance Technician', 'Post-overhaul service', 'All systems checked post-overhaul', 6, 1),
(10, 77, '2024-02-25', 'scheduled', 'Regular ambulance maintenance', 'Engine maintenance, Transmission, Medical systems', 235000, 70000, 'Mercedes Medical Service', 'Senior Ambulance Tech', 'Regular service due', 'Engine, transmission, medical systems serviced', 6, 1),
(10, 78, '2024-05-25', 'scheduled', 'Medical equipment calibration and battery replacement', 'Medical equipment calibration, Battery replacement', 155000, 75000, 'Medical Equipment Service', 'Medical Tech', 'Medical equipment service', 'Equipment calibrated, batteries replaced', 3, 1);

-- ==================================================
-- UPDATE SYSTEM LOGS FOR MAINTENANCE ACTIVITIES
-- ==================================================

INSERT INTO system_logs (user_id, action, entity_type, entity_id, ip_address) VALUES
(1, 'create', 'vehicle', 1, '127.0.0.1'),
(1, 'create', 'vehicle', 2, '127.0.0.1'),
(1, 'create', 'vehicle', 3, '127.0.0.1'),
(1, 'create', 'vehicle', 4, '127.0.0.1'),
(1, 'create', 'vehicle', 5, '127.0.0.1'),
(1, 'create', 'vehicle', 6, '127.0.0.1'),
(1, 'create', 'vehicle', 7, '127.0.0.1'),
(1, 'create', 'vehicle', 8, '127.0.0.1'),
(1, 'create', 'vehicle', 9, '127.0.0.1'),
(1, 'create', 'vehicle', 10, '127.0.0.1'),
(1, 'create', 'maintenance_schedule', 1, '127.0.0.1'),
(1, 'create', 'maintenance_schedule', 25, '127.0.0.1'),
(1, 'create', 'maintenance_schedule', 50, '127.0.0.1'),
(1, 'create', 'maintenance_schedule', 75, '127.0.0.1'),
(1, 'complete', 'maintenance', 1, '127.0.0.1'),
(1, 'complete', 'maintenance', 25, '127.0.0.1'),
(1, 'complete', 'maintenance', 50, '127.0.0.1'),
(1, 'complete', 'maintenance', 75, '127.0.0.1');

-- End of demo vehicles and maintenance data