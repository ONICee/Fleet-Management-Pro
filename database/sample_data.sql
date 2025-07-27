-- Sample Data for State Fleet Management System
-- This script adds realistic demo data for testing and demonstration

USE fleet_mgt;

-- Sample Vehicles Data
INSERT INTO vehicles (
    vehicle_brand, vehicle_model, serial_number, year_allotted, year_manufactured,
    vehicle_type, fuel_type, engine_number, chassis_number, license_plate, vin,
    tracker_number, tracker_imei, tracker_status, agency_id, deployment_location_id,
    serviceability, current_condition, current_mileage, purchase_date, purchase_price,
    supplier, last_overhaul, next_overhaul, last_scheduled_maintenance, next_scheduled_maintenance,
    insurance_policy, insurance_expiry, registration_expiry, status
) VALUES
-- State Police Command Vehicles
('Toyota', 'Hilux Double Cab', 'SPC-001-2024', '2024', '2024', 'truck', 'diesel', 
 'TH24001', 'TH24001CH', 'SPC-001', 'TH24001VIN123456', 'TRK001', '356999123456789', 'active',
 1, 1, 'serviceable', 'Excellent condition', 15000, '2024-01-15', 45000000.00, 'Toyota Nigeria Ltd',
 '2024-01-15', '2025-01-15', '2024-10-15', '2025-01-15', 'INS2024001', '2025-01-14', '2025-01-14', 'active'),

('Toyota', 'Corolla', 'SPC-002-2023', '2023', '2023', 'car', 'gasoline',
 'TC23002', 'TC23002CH', 'SPC-002', 'TC23002VIN789012', 'TRK002', '356999123456790', 'active',
 1, 1, 'serviceable', 'Good condition', 25000, '2023-06-10', 28000000.00, 'Toyota Nigeria Ltd',
 '2023-06-10', '2024-06-10', '2024-09-10', '2024-12-10', 'INS2023002', '2024-06-09', '2024-06-09', 'active'),

-- Federal Road Safety Corps Vehicles
('Ford', 'Ranger', 'FRSC-001-2024', '2024', '2024', 'truck', 'diesel',
 'FR24001', 'FR24001CH', 'FRSC-001', 'FR24001VIN345678', 'TRK003', '356999123456791', 'active',
 2, 2, 'serviceable', 'Excellent condition', 8000, '2024-03-20', 48000000.00, 'Ford Motors Nigeria',
 '2024-03-20', '2025-03-20', '2024-11-20', '2025-02-20', 'INS2024003', '2025-03-19', '2025-03-19', 'active'),

('Mitsubishi', 'L200', 'FRSC-002-2023', '2023', '2023', 'truck', 'diesel',
 'ML23002', 'ML23002CH', 'FRSC-002', 'ML23002VIN567890', 'TRK004', '356999123456792', 'inactive',
 2, 3, 'unserviceable', 'Under repair - engine issues', 45000, '2023-08-15', 42000000.00, 'Mitsubishi Motors',
 '2023-08-15', '2024-08-15', '2024-05-15', '2024-08-15', 'INS2023004', '2024-08-14', '2024-08-14', 'maintenance'),

-- Nigeria Security and Civil Defence Corps Vehicles
('Peugeot', '3008', 'NSCDC-001-2024', '2024', '2024', 'car', 'gasoline',
 'P308001', 'P308001CH', 'NSCDC-001', 'P308001VIN678901', 'TRK005', '356999123456793', 'active',
 3, 4, 'serviceable', 'Very good condition', 12000, '2024-02-10', 35000000.00, 'Peugeot Automobile Nigeria',
 '2024-02-10', '2025-02-10', '2024-10-10', '2025-01-10', 'INS2024005', '2025-02-09', '2025-02-09', 'active'),

-- State Traffic Management Agency Vehicles
('Honda', 'Civic', 'STMA-001-2023', '2023', '2023', 'car', 'gasoline',
 'HC23001', 'HC23001CH', 'STMA-001', 'HC23001VIN789012', 'TRK006', '356999123456794', 'active',
 4, 5, 'serviceable', 'Good working condition', 30000, '2023-09-05', 25000000.00, 'Honda Motors Nigeria',
 '2023-09-05', '2024-09-05', '2024-06-05', '2024-09-05', 'INS2023006', '2024-09-04', '2024-09-04', 'active'),

-- Nigeria Customs Service Vehicles
('Mercedes-Benz', 'Sprinter', 'NCS-001-2024', '2024', '2024', 'van', 'diesel',
 'MS24001', 'MS24001CH', 'NCS-001', 'MS24001VIN890123', 'TRK007', '356999123456795', 'active',
 5, 6, 'serviceable', 'Excellent condition', 5000, '2024-04-12', 65000000.00, 'Mercedes-Benz Nigeria',
 '2024-04-12', '2025-04-12', '2024-12-12', '2025-03-12', 'INS2024007', '2025-04-11', '2025-04-11', 'active'),

-- Nigeria Immigration Service Vehicles
('Nissan', 'Patrol', 'NIS-001-2023', '2023', '2023', 'truck', 'gasoline',
 'NP23001', 'NP23001CH', 'NIS-001', 'NP23001VIN901234', 'TRK008', '356999123456796', 'active',
 6, 7, 'serviceable', 'Good condition', 22000, '2023-11-18', 55000000.00, 'Nissan Motors Nigeria',
 '2023-11-18', '2024-11-18', '2024-08-18', '2024-11-18', 'INS2023008', '2024-11-17', '2024-11-17', 'active'),

-- Department of State Services Vehicles
('Land Rover', 'Discovery', 'DSS-001-2024', '2024', '2024', 'truck', 'gasoline',
 'LD24001', 'LD24001CH', 'DSS-001', 'LD24001VIN012345', 'TRK009', '356999123456797', 'active',
 7, 8, 'serviceable', 'Excellent condition', 3000, '2024-05-25', 85000000.00, 'Land Rover Nigeria',
 '2024-05-25', '2025-05-25', '2024-12-25', '2025-04-25', 'INS2024009', '2025-05-24', '2025-05-24', 'active'),

-- Nigeria Police Force Mobile Unit Vehicles
('Isuzu', 'D-Max', 'MOPOL-001-2024', '2024', '2024', 'truck', 'diesel',
 'ID24001', 'ID24001CH', 'MOPOL-001', 'ID24001VIN123456', 'TRK010', '356999123456798', 'active',
 8, 1, 'serviceable', 'Very good condition', 7500, '2024-06-30', 47000000.00, 'Isuzu Motors Nigeria',
 '2024-06-30', '2025-06-30', '2024-12-30', '2025-05-30', 'INS2024010', '2025-06-29', '2025-06-29', 'active');

-- Sample Maintenance Schedules
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description, scheduled_date,
    mileage_due, status, priority, estimated_cost, service_provider, notes
) VALUES
(1, 'scheduled', 'Oil Change & Filter', 'Regular 3-month oil change and filter replacement', '2024-12-15', 18000, 'scheduled', 'normal', 25000.00, 'Toyota Service Center', 'Due for routine maintenance'),
(2, 'scheduled', 'Brake Inspection', 'Quarterly brake system inspection and adjustment', '2024-12-10', 27000, 'scheduled', 'high', 35000.00, 'Toyota Service Center', 'Brake pads showing wear'),
(3, 'overhaul', 'Annual Overhaul', 'Comprehensive yearly vehicle overhaul', '2025-03-20', 10000, 'scheduled', 'high', 150000.00, 'Ford Authorized Center', 'Complete vehicle inspection and service'),
(4, 'unscheduled', 'Engine Repair', 'Engine diagnostics and repair', '2024-11-30', 45000, 'in_progress', 'critical', 250000.00, 'Mitsubishi Service Center', 'Engine misfiring - requires immediate attention'),
(5, 'scheduled', 'Tire Rotation', 'Tire rotation and alignment check', '2025-01-10', 15000, 'scheduled', 'normal', 15000.00, 'Peugeot Service Center', 'Regular tire maintenance');

-- Sample Maintenance History
INSERT INTO maintenance_history (
    vehicle_id, maintenance_date, maintenance_category, work_performed, parts_used,
    cost, mileage_at_service, service_provider, technician_name, created_by
) VALUES
(1, '2024-07-15', 'scheduled', 'Oil change, oil filter replacement, brake fluid top-up', 'Engine oil (5L), Oil filter, Brake fluid', 28000.00, 12000, 'Toyota Service Center', 'Eng. John Adebayo', 2),
(2, '2024-06-10', 'scheduled', 'Brake pad replacement, brake disc resurfacing', 'Front brake pads, Rear brake pads', 45000.00, 22000, 'Toyota Service Center', 'Mech. Sarah Okafor', 2),
(3, '2024-08-20', 'scheduled', 'Air filter replacement, spark plug change', 'Air filter, Spark plugs (4)', 18000.00, 6000, 'Ford Authorized Center', 'Tech. Ahmed Musa', 3),
(5, '2024-05-10', 'scheduled', 'Oil change, transmission service', 'Engine oil, Transmission fluid', 32000.00, 8000, 'Peugeot Service Center', 'Mech. Grace Eze', 2);

-- Sample Fuel Records
INSERT INTO fuel_records (
    vehicle_id, driver_id, fuel_station, fuel_type, quantity, price_per_unit,
    total_cost, mileage_at_fillup, receipt_number, fuel_date, location
) VALUES
(1, 1, 'Total Filling Station', 'diesel', 60.00, 617.00, 37020.00, 15000, 'RCP001234', '2024-11-20', 'State Capital'),
(2, 1, 'NNPC Mega Station', 'gasoline', 45.00, 568.00, 25560.00, 25000, 'RCP001235', '2024-11-19', 'State Capital'),
(3, 1, 'Mobil Station', 'diesel', 65.00, 617.00, 40105.00, 8000, 'RCP001236', '2024-11-18', 'Northern District'),
(5, 1, 'Oando Station', 'gasoline', 50.00, 568.00, 28400.00, 12000, 'RCP001237', '2024-11-17', 'Eastern Zone'),
(7, 1, 'Forte Oil Station', 'diesel', 70.00, 617.00, 43190.00, 5000, 'RCP001238', '2024-11-16', 'Border Patrol North');

-- Sample Notifications
INSERT INTO notifications (
    user_id, type, title, message, priority, is_read, action_required, related_id, related_type
) VALUES
(1, 'maintenance_due', 'Vehicle Maintenance Due', 'Toyota Hilux (SPC-001) is due for scheduled maintenance on December 15, 2024', 'high', 0, 1, 1, 'vehicle'),
(2, 'vehicle_issue', 'Vehicle Under Repair', 'Mitsubishi L200 (FRSC-002) has been moved to maintenance due to engine issues', 'urgent', 0, 1, 4, 'vehicle'),
(1, 'system', 'System Update', 'Fleet Management System has been updated with new features', 'normal', 1, 0, null, null),
(3, 'maintenance_due', 'Annual Overhaul Scheduled', 'Ford Ranger (FRSC-001) is scheduled for annual overhaul next month', 'normal', 0, 0, 3, 'vehicle'),
(2, 'fuel_alert', 'High Fuel Consumption', 'Mercedes-Benz Sprinter (NCS-001) showing higher than normal fuel consumption', 'normal', 0, 1, 7, 'vehicle');

-- Sample System Logs (recent activities)
INSERT INTO system_logs (
    user_id, action, entity_type, entity_id, ip_address, user_agent
) VALUES
(1, 'login', 'user', 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'view', 'vehicles', null, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'create', 'fuel_record', 5, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'update', 'vehicle', 4, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'view', 'maintenance', null, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'view', 'reports', null, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'view', 'dashboard', null, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'create', 'maintenance_schedule', 1, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

-- Additional deployment locations
INSERT INTO deployment_locations (location_name, local_government, senatorial_zone, state_zone, address) VALUES
('Highway Patrol Unit', 'Highway LGA', 'central', 'Zone I', 'Major Highway Checkpoint'),
('Marine Security Base', 'Coastal LGA', 'south', 'Zone J', 'State Waterways Security Base'),
('Aviation Security Unit', 'Airport LGA', 'central', 'Zone K', 'State Airport Security Wing'),
('Border Control Point East', 'Eastern Border LGA', 'central', 'Zone L', 'Eastern State Border Post'),
('Emergency Response Unit', 'Emergency LGA', 'central', 'Zone M', 'State Emergency Response Center');

-- Update some user last_login times for demo
UPDATE users SET last_login = NOW() - INTERVAL 1 DAY WHERE id = 1;
UPDATE users SET last_login = NOW() - INTERVAL 3 HOUR WHERE id = 2;
UPDATE users SET last_login = NOW() - INTERVAL 1 WEEK WHERE id = 3;

-- Create some drivers (linked to existing users)
INSERT INTO drivers (user_id, license_number, license_class, license_expiry, hire_date, emergency_contact_name, emergency_contact_phone, address, city, state, status) VALUES
(2, 'DL2024001', 'C', '2026-12-31', '2022-01-15', 'Mrs. Adebayo Kemi', '+234-802-123-4567', '123 Independence Way', 'State Capital', 'Demo State', 'active'),
(3, 'DL2024002', 'CE', '2025-08-30', '2023-03-10', 'Mr. Okafor Chidi', '+234-803-234-5678', '456 Freedom Street', 'Northern District', 'Demo State', 'active'),
(4, 'DL2024003', 'A', '2027-05-15', '2024-06-01', 'Miss Johnson Tope', '+234-804-345-6789', '789 Liberty Avenue', 'Southern District', 'Demo State', 'active');