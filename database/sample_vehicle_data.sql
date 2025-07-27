-- Additional Sample Vehicle Data for Testing
-- This script adds more realistic demo vehicles for comprehensive testing

USE fleet_mgt;

-- Insert additional sample vehicles (continuing from existing 10 vehicles)
INSERT INTO vehicles (
    vehicle_brand, vehicle_model, serial_number, year_allotted, year_manufactured,
    vehicle_type, fuel_type, engine_number, chassis_number, license_plate, vin,
    tracker_number, tracker_imei, tracker_status, agency_id, deployment_location_id,
    serviceability, current_condition, current_mileage, purchase_date, purchase_price,
    supplier, last_overhaul, next_overhaul, last_scheduled_maintenance, next_scheduled_maintenance,
    insurance_policy, insurance_expiry, registration_expiry, status
) VALUES

-- Additional State Police Command Vehicles
('Toyota', 'Camry', 'SPC-003-2024', '2024', '2024', 'car', 'gasoline', 
 'TC24003', 'TC24003CH', 'SPC-003', 'TC24003VIN345678', 'TRK011', '356999123456799', 'active',
 1, 1, 'serviceable', 'New vehicle - excellent condition', 5000, '2024-08-01', 32000000.00, 'Toyota Nigeria Ltd',
 NULL, '2025-08-01', '2024-11-01', '2025-02-01', 'INS2024011', '2025-07-31', '2025-07-31', 'active'),

('Toyota', 'Prado', 'SPC-004-2023', '2023', '2023', 'truck', 'gasoline',
 'TP23004', 'TP23004CH', 'SPC-004', 'TP23004VIN456789', 'TRK012', '356999123456800', 'active',
 1, 2, 'serviceable', 'Well maintained - good condition', 18000, '2023-04-20', 65000000.00, 'Toyota Nigeria Ltd',
 '2023-04-20', '2024-04-20', '2024-07-20', '2024-10-20', 'INS2023012', '2024-04-19', '2024-04-19', 'active'),

-- Additional FRSC Vehicles
('Hyundai', 'Elantra', 'FRSC-003-2024', '2024', '2024', 'car', 'gasoline',
 'HE24003', 'HE24003CH', 'FRSC-003', 'HE24003VIN567890', 'TRK013', '356999123456801', 'active',
 2, 3, 'serviceable', 'Standard patrol vehicle', 12000, '2024-07-15', 22000000.00, 'Hyundai Motors Nigeria',
 NULL, '2025-07-15', '2024-10-15', '2025-01-15', 'INS2024013', '2025-07-14', '2025-07-14', 'active'),

('Kia', 'Sorento', 'FRSC-004-2023', '2023', '2023', 'truck', 'gasoline',
 'KS23004', 'KS23004CH', 'FRSC-004', 'KS23004VIN678901', 'TRK014', '356999123456802', 'inactive',
 2, 4, 'unserviceable', 'Accident damage - under repair', 35000, '2023-10-10', 38000000.00, 'Kia Motors Nigeria',
 '2023-10-10', '2024-10-10', '2024-01-10', '2024-07-10', 'INS2023014', '2024-10-09', '2024-10-09', 'maintenance'),

-- NSCDC Additional Vehicles
('Honda', 'Accord', 'NSCDC-002-2024', '2024', '2024', 'car', 'gasoline',
 'HA24002', 'HA24002CH', 'NSCDC-002', 'HA24002VIN789012', 'TRK015', '356999123456803', 'active',
 3, 5, 'serviceable', 'Executive transport vehicle', 8000, '2024-09-01', 30000000.00, 'Honda Motors Nigeria',
 NULL, '2025-09-01', '2024-12-01', '2025-03-01', 'INS2024015', '2025-08-31', '2025-08-31', 'active'),

-- State Traffic Management Agency Vehicles
('Mazda', 'CX-5', 'STMA-002-2024', '2024', '2024', 'car', 'gasoline',
 'MC24002', 'MC24002CH', 'STMA-002', 'MC24002VIN890123', 'TRK016', '356999123456804', 'active',
 4, 6, 'serviceable', 'Traffic management unit', 6000, '2024-06-15', 35000000.00, 'Mazda Motors Nigeria',
 NULL, '2025-06-15', '2024-09-15', '2024-12-15', 'INS2024016', '2025-06-14', '2025-06-14', 'active'),

('Volkswagen', 'Tiguan', 'STMA-003-2023', '2023', '2023', 'truck', 'gasoline',
 'VT23003', 'VT23003CH', 'STMA-003', 'VT23003VIN901234', 'TRK017', '356999123456805', 'active',
 4, 7, 'serviceable', 'Highway patrol vehicle', 28000, '2023-12-05', 42000000.00, 'Volkswagen Nigeria',
 '2023-12-05', '2024-12-05', '2024-03-05', '2024-09-05', 'INS2023017', '2024-12-04', '2024-12-04', 'active'),

-- Nigeria Customs Service Additional
('Toyota', 'Coaster', 'NCS-002-2023', '2023', '2023', 'bus', 'diesel',
 'TCO23002', 'TCO23002CH', 'NCS-002', 'TCO23002VIN012345', 'TRK018', '356999123456806', 'active',
 5, 8, 'serviceable', 'Personnel transport bus', 45000, '2023-05-20', 85000000.00, 'Toyota Nigeria Ltd',
 '2023-05-20', '2024-05-20', '2024-08-20', '2024-11-20', 'INS2023018', '2024-05-19', '2024-05-19', 'active'),

-- Nigeria Immigration Service Additional
('Mitsubishi', 'Outlander', 'NIS-002-2024', '2024', '2024', 'truck', 'gasoline',
 'MO24002', 'MO24002CH', 'NIS-002', 'MO24002VIN123456', 'TRK019', '356999123456807', 'active',
 6, 1, 'serviceable', 'Border patrol vehicle', 10000, '2024-03-15', 40000000.00, 'Mitsubishi Motors Nigeria',
 NULL, '2025-03-15', '2024-06-15', '2024-12-15', 'INS2024019', '2025-03-14', '2025-03-14', 'active'),

-- DSS Additional Vehicle
('BMW', 'X3', 'DSS-002-2024', '2024', '2024', 'truck', 'gasoline',
 'BX24002', 'BX24002CH', 'DSS-002', 'BX24002VIN234567', 'TRK020', '356999123456808', 'active',
 7, 2, 'serviceable', 'Intelligence operations vehicle', 2000, '2024-10-01', 95000000.00, 'BMW Nigeria',
 NULL, '2025-10-01', '2025-01-01', '2025-04-01', 'INS2024020', '2025-09-30', '2025-09-30', 'active'),

-- Police Mobile Unit Additional
('Toyota', 'Hiace', 'MOPOL-002-2023', '2023', '2023', 'van', 'diesel',
 'TH23002', 'TH23002CH', 'MOPOL-002', 'TH23002VIN345678', 'TRK021', '356999123456809', 'active',
 8, 3, 'serviceable', 'Mobile unit transport', 32000, '2023-07-10', 50000000.00, 'Toyota Nigeria Ltd',
 '2023-07-10', '2024-07-10', '2024-04-10', '2024-10-10', 'INS2023021', '2024-07-09', '2024-07-09', 'active'),

-- Specialized Vehicles
('Yamaha', 'FZ150', 'SPC-005-2024', '2024', '2024', 'motorcycle', 'gasoline',
 'YF24005', 'YF24005CH', 'SPC-005', 'YF24005VIN456789', 'TRK022', '356999123456810', 'active',
 1, 4, 'serviceable', 'Traffic patrol motorcycle', 8000, '2024-04-10', 1800000.00, 'Yamaha Motors Nigeria',
 NULL, '2025-04-10', '2024-07-10', '2024-10-10', 'INS2024022', '2025-04-09', '2025-04-09', 'active'),

('Suzuki', 'GSX-R150', 'STMA-004-2024', '2024', '2024', 'motorcycle', 'gasoline',
 'SG24004', 'SG24004CH', 'STMA-004', 'SG24004VIN567890', 'TRK023', '356999123456811', 'active',
 4, 5, 'serviceable', 'Emergency response motorcycle', 5000, '2024-08-20', 2200000.00, 'Suzuki Motors Nigeria',
 NULL, '2025-08-20', '2024-11-20', '2025-02-20', 'INS2024023', '2025-08-19', '2025-08-19', 'active'),

-- Marine Vehicles
('Yamaha', 'F200', 'NIS-003-2023', '2023', '2023', 'boat', 'gasoline',
 'YFB23003', 'YFB23003CH', 'NIS-003', 'YFB23003VIN678901', 'TRK024', '356999123456812', 'active',
 6, 9, 'serviceable', 'Border patrol boat', 500, '2023-11-25', 75000000.00, 'Yamaha Marine Nigeria',
 '2023-11-25', '2024-11-25', '2024-05-25', '2024-08-25', 'INS2023024', '2024-11-24', '2024-11-24', 'active'),

-- Aerial Vehicle
('DJI', 'Matrice 300', 'DSS-003-2024', '2024', '2024', 'drone', 'battery',
 'DM24003', 'DM24003CH', 'DSS-003', 'DM24003VIN789012', 'TRK025', '356999123456813', 'active',
 7, 10, 'serviceable', 'Surveillance drone', 100, '2024-05-15', 25000000.00, 'DJI Nigeria',
 NULL, '2025-05-15', '2024-08-15', '2024-11-15', 'INS2024025', '2025-05-14', '2025-05-14', 'active');

-- Additional Fuel Records for new vehicles
INSERT INTO fuel_records (
    vehicle_id, driver_id, fuel_station, fuel_type, quantity, price_per_unit,
    total_cost, mileage_at_fillup, receipt_number, fuel_date, location
) VALUES
(11, 2, 'Conoil Station', 'gasoline', 40.00, 568.00, 22720.00, 5000, 'RCP001239', '2024-11-15', 'State Capital'),
(12, 2, 'NNPC Retail', 'gasoline', 55.00, 568.00, 31240.00, 18000, 'RCP001240', '2024-11-14', 'Northern District'),
(13, 3, 'Total Station', 'gasoline', 35.00, 568.00, 19880.00, 12000, 'RCP001241', '2024-11-13', 'Southern District'),
(14, 3, 'Mobil Station', 'gasoline', 48.00, 568.00, 27264.00, 35000, 'RCP001242', '2024-11-12', 'Eastern Zone'),
(15, 1, 'Forte Oil', 'gasoline', 42.00, 568.00, 23856.00, 8000, 'RCP001243', '2024-11-11', 'Western Zone'),
(16, 1, 'NNPC Mega Station', 'gasoline', 38.00, 568.00, 21584.00, 6000, 'RCP001244', '2024-11-10', 'Border Patrol North'),
(17, 2, 'Oando Station', 'gasoline', 45.00, 568.00, 25560.00, 28000, 'RCP001245', '2024-11-09', 'Border Patrol South'),
(18, 3, 'Total Station', 'diesel', 75.00, 617.00, 46275.00, 45000, 'RCP001246', '2024-11-08', 'Airport Security'),
(19, 1, 'Mobil Station', 'gasoline', 33.00, 568.00, 18744.00, 10000, 'RCP001247', '2024-11-07', 'Highway Patrol'),
(20, 2, 'Conoil Station', 'gasoline', 50.00, 568.00, 28400.00, 2000, 'RCP001248', '2024-11-06', 'Marine Base');

-- Additional Maintenance Schedules
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description, scheduled_date,
    mileage_due, status, priority, estimated_cost, service_provider, notes
) VALUES
(11, 'scheduled', 'First Service', 'New vehicle first service check', '2024-12-01', 6000, 'scheduled', 'normal', 35000.00, 'Toyota Service Center', 'First service for new Camry'),
(12, 'scheduled', 'Oil Change', 'Regular oil change and filter replacement', '2024-12-05', 20000, 'scheduled', 'normal', 28000.00, 'Toyota Service Center', 'Routine maintenance'),
(13, 'unscheduled', 'Brake Service', 'Brake pads replacement needed', '2024-11-30', 12500, 'in_progress', 'high', 45000.00, 'Hyundai Service Center', 'Brake pads worn out'),
(15, 'scheduled', 'Tire Rotation', 'Tire rotation and balancing', '2024-12-10', 9000, 'scheduled', 'normal', 18000.00, 'Honda Service Center', 'Regular tire maintenance'),
(16, 'scheduled', 'Air Filter Change', 'Air filter and cabin filter replacement', '2024-12-15', 7000, 'scheduled', 'normal', 12000.00, 'Mazda Service Center', 'Filter replacement due'),
(20, 'overhaul', 'Annual Overhaul', 'Comprehensive vehicle inspection and service', '2025-10-01', 3000, 'scheduled', 'high', 180000.00, 'BMW Authorized Center', 'Annual overhaul for executive vehicle');

-- Update user last login times for more realistic demo
UPDATE users SET last_login = NOW() - INTERVAL 2 HOUR WHERE id = 1;
UPDATE users SET last_login = NOW() - INTERVAL 1 DAY WHERE id = 2;
UPDATE users SET last_login = NOW() - INTERVAL 3 DAY WHERE id = 3;
UPDATE users SET last_login = NOW() - INTERVAL 1 WEEK WHERE id = 4;

-- Add more deployment locations for variety
INSERT INTO deployment_locations (location_name, local_government, senatorial_zone, state_zone, address) VALUES
('State House Security', 'Government LGA', 'central', 'Zone N', 'Governor\'s Office Complex'),
('Legislature Complex', 'Assembly LGA', 'central', 'Zone O', 'State House of Assembly'),
('Judiciary Security', 'High Court LGA', 'central', 'Zone P', 'State High Court Complex'),
('Prison Command', 'Correctional LGA', 'central', 'Zone Q', 'State Correctional Center'),
('Fire Service Station', 'Fire LGA', 'north', 'Zone R', 'State Fire Service Headquarters');

-- Add some system activity logs
INSERT INTO system_logs (
    user_id, action, entity_type, entity_id, ip_address, user_agent
) VALUES
(1, 'create', 'vehicle', 11, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'create', 'vehicle', 12, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'create', 'vehicle', 13, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'create', 'fuel_record', 11, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'create', 'fuel_record', 12, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'view', 'reports', null, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'view', 'system_logs', null, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'update', 'user', 3, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

-- Add some notifications for demo
INSERT INTO notifications (
    user_id, type, title, message, priority, is_read, action_required, related_id, related_type
) VALUES
(1, 'maintenance_due', 'New Vehicle Service Due', 'Toyota Camry (SPC-003) is due for first service on December 1, 2024', 'normal', 0, 1, 11, 'vehicle'),
(2, 'maintenance_due', 'Brake Service Required', 'Hyundai Elantra (FRSC-003) requires immediate brake service', 'high', 0, 1, 13, 'vehicle'),
(1, 'vehicle_issue', 'Vehicle Added', 'BMW X3 (DSS-002) has been successfully added to the fleet', 'normal', 1, 0, 20, 'vehicle'),
(3, 'fuel_alert', 'Fuel Cost Alert', 'Monthly fuel expenditure has exceeded ₦500,000', 'normal', 0, 0, null, null),
(2, 'system', 'Database Backup', 'Weekly database backup completed successfully', 'low', 1, 0, null, null);