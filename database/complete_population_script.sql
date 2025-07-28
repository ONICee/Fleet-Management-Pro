-- Complete Database Population Script
-- Compatible with your current database structure
-- Run this after clearing your database and importing your dump

USE fleet_mgt;

-- Disable foreign key checks temporarily for smooth insertion
SET FOREIGN_KEY_CHECKS = 0;

-- ==================================================
-- 1. ADD MORE DRIVERS (linked to existing users)
-- ==================================================

INSERT INTO drivers (user_id, license_number, license_class, license_expiry, hire_date, emergency_contact_name, emergency_contact_phone, address, city, state, status, rating) VALUES
(2, 'LIC-ADM-001', 'C', '2026-12-31', '2023-01-15', 'Mary Johnson', '08012345678', '12 Government Road', 'Abuja', 'FCT', 'active', 4.8),
(3, 'LIC-DEO-001', 'B', '2025-08-30', '2024-02-01', 'Peter Okafor', '08023456789', '45 Police Barracks', 'Lagos', 'Lagos', 'active', 4.5),
(4, 'LIC-GUEST-001', 'B', '2025-12-15', '2024-03-01', 'Grace Adebayo', '08034567890', '78 Civil Service Estate', 'Kano', 'Kano', 'active', 4.2),
(5, 'LIC-SUP-002', 'A', '2027-06-30', '2022-05-15', 'John Castro', '08045678901', '23 VIP Quarters', 'Abuja', 'FCT', 'active', 5.0);

-- ==================================================
-- 2. ADD MORE VEHICLES (continuing from your existing 11)
-- ==================================================

INSERT INTO vehicles (
    vehicle_brand, vehicle_model, serial_number, year_allotted, year_manufactured,
    vehicle_type, fuel_type, engine_number, chassis_number, license_plate, vin,
    tracker_number, tracker_imei, tracker_status, agency_id, deployment_location_id,
    serviceability, current_condition, current_mileage, purchase_date, purchase_price,
    supplier, last_overhaul, next_overhaul, last_scheduled_maintenance, next_scheduled_maintenance,
    insurance_policy, insurance_expiry, registration_expiry, status
) VALUES

-- Additional State Police Vehicles
('Toyota', 'Land Cruiser', 'SPC-009-2024', 2024, 2024, 'truck', 'diesel',
'LC24009', 'LC24009CH', 'SPC-009', 'LC24009VIN901234', 'TRK011', '356999123456799',
'active', 1, 1, 'serviceable', 'Command vehicle - excellent condition', 8500,
'2024-02-28', 95000000.00, 'Toyota Nigeria Ltd', '2024-02-28', '2025-02-28',
'2024-11-28', '2025-02-28', 'INS2024011', '2025-02-27', '2025-02-27', 'active'),

('Honda', 'CRV', 'SPC-010-2023', 2023, 2023, 'car', 'gasoline',
'CRV23010', 'CRV23010CH', 'SPC-010', 'CRV23010VIN234567', 'TRK012', '356999123456800',
'active', 1, 5, 'serviceable', 'Patrol vehicle - good condition', 32000,
'2023-07-12', 38000000.00, 'Honda Motors Nigeria', '2023-07-12', '2024-07-12',
'2024-04-12', '2024-07-12', 'INS2023012', '2024-07-11', '2024-07-11', 'active'),

-- Additional FRSC Vehicles
('Hyundai', 'Santa Fe', 'FRSC-003-2024', 2024, 2024, 'car', 'gasoline',
'SF24003', 'SF24003CH', 'FRSC-003', 'SF24003VIN345678', 'TRK013', '356999123456801',
'active', 2, 2, 'serviceable', 'Highway patrol - excellent', 6200,
'2024-04-18', 52000000.00, 'Hyundai Motors Nigeria', '2024-04-18', '2025-04-18',
'2024-12-18', '2025-03-18', 'INS2024013', '2025-04-17', '2025-04-17', 'active'),

('Kia', 'Sorento', 'FRSC-004-2023', 2023, 2023, 'car', 'diesel',
'KS23004', 'KS23004CH', 'FRSC-004', 'KS23004VIN456789', 'TRK014', '356999123456802',
'active', 2, 3, 'serviceable', 'Highway rescue vehicle', 28600,
'2023-09-25', 48000000.00, 'Kia Motors Nigeria', '2023-09-25', '2024-09-25',
'2024-06-25', '2024-09-25', 'INS2023014', '2024-09-24', '2024-09-24', 'active'),

-- Additional NSCDC Vehicles
('Mercedes-Benz', 'Vito', 'NSCDC-002-2024', 2024, 2024, 'van', 'diesel',
'MV24002', 'MV24002CH', 'NSCDC-002', 'MV24002VIN567890', 'TRK015', '356999123456803',
'active', 3, 4, 'serviceable', 'Personnel transport van', 12800,
'2024-01-30', 58000000.00, 'Mercedes-Benz Nigeria', '2024-01-30', '2025-01-30',
'2024-10-30', '2025-01-30', 'INS2024015', '2025-01-29', '2025-01-29', 'active'),

('Iveco', 'Daily', 'NSCDC-003-2023', 2023, 2023, 'bus', 'diesel',
'ID23003', 'ID23003CH', 'NSCDC-003', 'ID23003VIN678901', 'TRK016', '356999123456804',
'active', 3, 3, 'serviceable', 'Security personnel bus', 45200,
'2023-12-05', 72000000.00, 'Iveco Nigeria', '2023-12-05', '2024-12-05',
'2024-09-05', '2024-12-05', 'INS2023016', '2024-12-04', '2024-12-04', 'active'),

-- Additional Customs Vehicles
('Ford', 'Everest', 'NCS-002-2024', 2024, 2024, 'truck', 'diesel',
'FE24002', 'FE24002CH', 'NCS-002', 'FE24002VIN789012', 'TRK017', '356999123456805',
'active', 5, 6, 'serviceable', 'Border patrol SUV', 9400,
'2024-03-14', 62000000.00, 'Ford Motors Nigeria', '2024-03-14', '2025-03-14',
'2024-12-14', '2025-03-14', 'INS2024017', '2025-03-13', '2025-03-13', 'active'),

-- Additional Immigration Vehicles
('Chevrolet', 'Tahoe', 'NIS-002-2024', 2024, 2024, 'truck', 'gasoline',
'CT24002', 'CT24002CH', 'NIS-002', 'CT24002VIN890123', 'TRK018', '356999123456806',
'active', 6, 7, 'serviceable', 'Immigration patrol vehicle', 7800,
'2024-05-08', 78000000.00, 'General Motors Nigeria', '2024-05-08', '2025-05-08',
'2024-12-08', '2025-04-08', 'INS2024018', '2025-05-07', '2025-05-07', 'active'),

-- Additional DSS Vehicles
('BMW', 'X5', 'DSS-002-2024', 2024, 2024, 'car', 'gasoline',
'BX524002', 'BX524002CH', 'DSS-002', 'BX524002VIN901234', 'TRK019', '356999123456807',
'active', 7, 8, 'serviceable', 'Executive surveillance vehicle', 4200,
'2024-06-20', 125000000.00, 'BMW Nigeria', '2024-06-20', '2025-06-20',
'2024-12-20', '2025-05-20', 'INS2024019', '2025-06-19', '2025-06-19', 'active'),

-- Additional Mobile Police Vehicles
('Toyota', 'Coaster', 'MOPOL-002-2023', 2023, 2023, 'bus', 'diesel',
'TC23002', 'TC23002CH', 'MOPOL-002', 'TC23002VIN012345', 'TRK020', '356999123456808',
'active', 8, 1, 'serviceable', 'Personnel carrier bus', 38500,
'2023-10-15', 85000000.00, 'Toyota Nigeria Ltd', '2023-10-15', '2024-10-15',
'2024-07-15', '2024-10-15', 'INS2023020', '2024-10-14', '2024-10-14', 'active');

-- ==================================================
-- 3. ADD VEHICLE ASSIGNMENTS
-- ==================================================

INSERT INTO vehicle_assignments (vehicle_id, driver_id, assigned_date, status, notes) VALUES
(1, 1, '2024-01-20', 'active', 'Primary driver for SPC Hilux'),
(2, 1, '2024-02-01', 'active', 'Assigned to admin driver'),
(3, 2, '2024-02-15', 'active', 'Regular patrol assignment'),
(4, 2, '2024-03-01', 'active', 'FRSC highway patrol'),
(5, 3, '2024-01-30', 'completed', 'Temporary assignment - vehicle in maintenance'),
(6, 3, '2024-03-10', 'active', 'NSCDC security patrol'),
(7, 4, '2024-04-01', 'active', 'Traffic management duties'),
(12, 1, '2024-03-15', 'active', 'Command vehicle assignment'),
(13, 2, '2024-04-20', 'active', 'Highway patrol assignment'),
(14, 3, '2024-05-01', 'active', 'Highway rescue duties');

-- ==================================================
-- 4. ADD COMPREHENSIVE MAINTENANCE SCHEDULES
-- ==================================================

INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description, scheduled_date,
    mileage_due, status, priority, estimated_cost, actual_cost, service_provider,
    work_order_number, parts_replaced, labor_hours, notes, completed_date,
    next_service_date, authorized_by, performed_by
) VALUES

-- Vehicle 12 (Toyota Land Cruiser) Schedules
(12, 'scheduled', 'Oil Change', 'Regular oil and filter change - 5000km service', '2024-07-28', 10000, 'completed', 'normal', 35000, 33500, 'Toyota Service Center', 'WO-2024-101', 'Engine oil, oil filter', 1.5, 'Routine maintenance completed', '2024-07-28', '2024-10-28', 1, 'Senior Technician'),
(12, 'scheduled', 'Major Service', '15000km comprehensive service', '2024-10-28', 15000, 'scheduled', 'normal', 95000, NULL, 'Toyota Service Center', NULL, NULL, NULL, 'Comprehensive service due', NULL, '2025-01-28', 1, NULL),

-- Vehicle 13 (Honda CRV) Schedules
(13, 'scheduled', 'Oil Change', 'Honda CRV oil service', '2024-08-15', 35000, 'scheduled', 'normal', 28000, NULL, 'Honda Service Center', NULL, NULL, NULL, 'Regular oil change due', NULL, '2024-11-15', 1, NULL),
(13, 'unscheduled', 'AC Repair', 'Air conditioning system repair', '2024-07-30', 32500, 'completed', 'normal', 45000, 42000, 'Auto AC Specialist', 'WO-2024-102', 'AC compressor belt', 3.0, 'AC repair completed', '2024-07-30', NULL, 1, 'AC Technician'),

-- Vehicle 14 (Hyundai Santa Fe) Schedules
(14, 'scheduled', 'First Service', 'New vehicle first service', '2024-08-18', 5000, 'scheduled', 'normal', 25000, NULL, 'Hyundai Service Center', NULL, NULL, NULL, 'First service for new vehicle', NULL, '2024-11-18', 1, NULL),

-- Vehicle 15 (Kia Sorento) Schedules
(15, 'scheduled', 'Major Service', 'Annual comprehensive service', '2024-09-25', 35000, 'scheduled', 'high', 120000, NULL, 'Kia Service Center', NULL, NULL, NULL, 'Annual service due', NULL, '2025-03-25', 1, NULL),
(15, 'unscheduled', 'Tire Replacement', 'Emergency tire replacement', '2024-08-10', 29000, 'completed', 'high', 85000, 80000, 'Tire Specialist', 'WO-2024-103', 'Tires x4', 2.0, 'Tire replacement due to damage', '2024-08-10', NULL, 1, 'Tire Expert'),

-- Vehicle 16 (Mercedes Vito) Schedules
(16, 'scheduled', 'Oil Change', 'Van oil service', '2024-08-30', 15000, 'scheduled', 'normal', 40000, NULL, 'Mercedes Service Center', NULL, NULL, NULL, 'Van oil change due', NULL, '2024-11-30', 1, NULL),

-- Vehicle 17 (Iveco Daily) Schedules
(17, 'overhaul', 'Annual Overhaul', 'Bus annual overhaul', '2024-12-05', 50000, 'scheduled', 'high', 350000, NULL, 'Iveco Service Center', NULL, NULL, NULL, 'Annual bus overhaul', NULL, '2025-12-05', 1, NULL),

-- Vehicle 18 (Ford Everest) Schedules
(18, 'scheduled', 'Oil Change', 'Border patrol vehicle service', '2024-09-14', 12000, 'scheduled', 'normal', 32000, NULL, 'Ford Service Center', NULL, NULL, NULL, 'Regular maintenance', NULL, '2024-12-14', 1, NULL),

-- Vehicle 19 (Chevrolet Tahoe) Schedules
(19, 'scheduled', 'Major Service', 'Immigration vehicle major service', '2024-11-08', 10000, 'scheduled', 'normal', 75000, NULL, 'Chevrolet Service Center', NULL, NULL, NULL, 'Major service due', NULL, '2025-02-08', 1, NULL),

-- Vehicle 20 (BMW X5) Schedules
(20, 'scheduled', 'Premium Service', 'BMW premium service', '2024-12-20', 8000, 'scheduled', 'high', 150000, NULL, 'BMW Service Center', NULL, NULL, NULL, 'Premium vehicle service', NULL, '2025-03-20', 1, NULL),

-- Vehicle 21 (Toyota Coaster) Schedules
(21, 'scheduled', 'Bus Service', 'Personnel carrier service', '2024-10-15', 42000, 'scheduled', 'normal', 180000, NULL, 'Toyota Service Center', NULL, NULL, NULL, 'Bus comprehensive service', NULL, '2025-01-15', 1, NULL);

-- ==================================================
-- 5. ADD MAINTENANCE HISTORY
-- ==================================================

INSERT INTO maintenance_history (
    vehicle_id, maintenance_schedule_id, maintenance_date, maintenance_category,
    work_performed, parts_used, cost, mileage_at_service, service_provider,
    technician_name, before_condition, after_condition, warranty_period, created_by
) VALUES

-- Additional history for existing vehicles
(12, 1, '2024-07-28', 'scheduled', 'Oil and filter change for Land Cruiser command vehicle', 'Engine oil 6L, Oil filter, Air filter', 33500, 10000, 'Toyota Service Center', 'Master Technician John', 'Oil change due', 'Fresh oil, excellent condition', 6, 1),
(13, 2, '2024-07-30', 'unscheduled', 'AC compressor belt replacement', 'AC compressor belt, refrigerant top-up', 42000, 32500, 'Auto AC Specialist', 'AC Expert Mike', 'AC not cooling properly', 'AC fully functional', 12, 1),
(15, 2, '2024-08-10', 'unscheduled', 'All four tires replaced due to highway debris damage', 'Michelin tires x4, wheel balancing', 80000, 29000, 'Tire Specialist', 'Tire Professional James', 'Multiple tire damage', 'New tires, proper alignment', 24, 1);

-- ==================================================
-- 6. ADD FUEL RECORDS
-- ==================================================

INSERT INTO fuel_records (vehicle_id, driver_id, fuel_station, fuel_type, quantity, price_per_unit, total_cost, mileage_at_fillup, receipt_number, fuel_date, location) VALUES

-- Recent fuel records for active vehicles
(1, 1, 'NNPC Mega Station', 'diesel', 65.50, 617.00, 40413.50, 18500, 'RCP-2024-1001', '2024-07-25', 'Central Business District'),
(2, 1, 'Total Energies', 'diesel', 70.20, 622.00, 43664.40, 15200, 'RCP-2024-1002', '2024-07-26', 'Victoria Island'),
(3, 2, 'Mobil', 'gasoline', 45.80, 568.00, 26014.40, 25300, 'RCP-2024-1003', '2024-07-27', 'Ikeja GRA'),
(4, 2, 'Conoil', 'diesel', 68.30, 615.00, 42004.50, 8200, 'RCP-2024-1004', '2024-07-27', 'Abuja Expressway'),
(6, 3, 'Oando', 'gasoline', 52.40, 572.00, 29972.80, 12300, 'RCP-2024-1005', '2024-07-28', 'Garki District'),
(7, 4, 'MRS', 'gasoline', 48.60, 565.00, 27459.00, 30500, 'RCP-2024-1006', '2024-07-28', 'Wuse II'),
(12, 1, 'NNPC', 'diesel', 80.40, 620.00, 49848.00, 8700, 'RCP-2024-1007', '2024-07-28', 'Aso Drive'),
(13, 2, 'Total', 'gasoline', 58.20, 570.00, 33174.00, 32800, 'RCP-2024-1008', '2024-07-28', 'Gwarinpa');

-- ==================================================
-- 7. ADD TRIPS
-- ==================================================

INSERT INTO trips (
    trip_number, vehicle_id, driver_id, route_name, start_location, end_location,
    planned_departure, planned_arrival, actual_departure, actual_arrival,
    start_mileage, end_mileage, distance_planned, distance_actual, fuel_consumed,
    status, priority, cargo_description, special_instructions, created_by
) VALUES

-- Recent and ongoing trips
('TRP-2024-001', 2, 1, 'City Patrol Route A', 'State Police HQ', 'Central Business District', 
'2024-07-28 08:00:00', '2024-07-28 16:00:00', '2024-07-28 08:05:00', '2024-07-28 16:10:00',
15000, 15120, 120.00, 120.00, 12.50, 'completed', 'normal', 'Patrol duty', 'Regular patrol - maintain radio contact', 1),

('TRP-2024-002', 4, 2, 'Highway Patrol', 'FRSC Command', 'Lagos-Ibadan Expressway KM 25', 
'2024-07-28 06:00:00', '2024-07-28 18:00:00', '2024-07-28 06:00:00', NULL,
8000, NULL, 250.00, NULL, NULL, 'in_progress', 'high', 'Highway patrol equipment', 'Monitor traffic violations', 1),

('TRP-2024-003', 6, 3, 'Security Round', 'NSCDC Base', 'Industrial Estate', 
'2024-07-28 09:00:00', '2024-07-28 17:00:00', '2024-07-28 09:15:00', NULL,
12200, NULL, 85.00, NULL, NULL, 'in_progress', 'normal', 'Security personnel x4', 'Industrial area security check', 1),

('TRP-2024-004', 12, 1, 'VIP Transport', 'Government House', 'Airport', 
'2024-07-28 14:00:00', '2024-07-28 15:30:00', NULL, NULL,
8500, NULL, 45.00, NULL, NULL, 'planned', 'urgent', 'VIP passenger', 'High security protocol required', 1),

('TRP-2024-005', 7, 4, 'Traffic Control', 'STMA Office', 'Major Junction Network', 
'2024-07-29 07:00:00', '2024-07-29 19:00:00', NULL, NULL,
30300, NULL, 180.00, NULL, NULL, 'planned', 'normal', 'Traffic control equipment', 'Rush hour traffic management', 1);

-- ==================================================
-- 8. ADD NOTIFICATIONS
-- ==================================================

INSERT INTO notifications (user_id, type, title, message, priority, is_read, action_required, related_id, related_type) VALUES

-- Maintenance notifications
(1, 'maintenance_due', 'Vehicle Maintenance Due', 'Toyota Land Cruiser SPC-009-2024 is due for scheduled maintenance on 2024-10-28', 'normal', 0, 1, 12, 'vehicle'),
(1, 'maintenance_due', 'Overdue Maintenance Alert', 'Honda CRV SPC-010-2023 oil change is overdue by 5 days', 'high', 0, 1, 13, 'vehicle'),
(2, 'vehicle_issue', 'Vehicle Status Update', 'Mitsubishi L200 FRSC-002-2023 maintenance completed, vehicle ready for service', 'normal', 0, 0, 5, 'vehicle'),

-- Fuel alerts
(1, 'fuel_alert', 'High Fuel Consumption', 'BMW X5 DSS-002-2024 showing higher than normal fuel consumption', 'normal', 0, 0, 20, 'vehicle'),
(3, 'fuel_alert', 'Fuel Record Due', 'Multiple vehicles require fuel record updates', 'low', 0, 1, NULL, NULL),

-- Document expiry
(1, 'document_expiry', 'Insurance Expiring Soon', '3 vehicles have insurance policies expiring within 30 days', 'high', 0, 1, NULL, NULL),
(2, 'document_expiry', 'Registration Renewal', 'Vehicle registration for multiple vehicles due for renewal', 'normal', 0, 1, NULL, NULL),

-- Trip notifications
(1, 'trip_delay', 'Trip Delay Alert', 'Highway patrol trip TRP-2024-002 experiencing delays due to traffic', 'normal', 0, 0, 2, 'trip'),
(4, 'system', 'Welcome Message', 'Welcome to the State Fleet Management System. Your account has been activated.', 'low', 0, 0, NULL, NULL);

-- ==================================================
-- 9. ADD SYSTEM LOGS
-- ==================================================

INSERT INTO system_logs (user_id, action, entity_type, entity_id, ip_address, user_agent) VALUES

-- Recent system activities
(1, 'create', 'vehicle', 12, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'create', 'vehicle', 13, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'update', 'maintenance_schedule', 4, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'create', 'fuel_record', 5, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'create', 'trip', 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'complete', 'maintenance', 1, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(2, 'create', 'driver', 1, '192.168.1.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(5, 'login', 'user', 5, '192.168.1.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(1, 'update', 'vehicle', 5, '192.168.1.100', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'),
(3, 'create', 'trip', 3, '192.168.1.102', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');

-- ==================================================
-- 10. ADD SETTINGS
-- ==================================================

INSERT INTO settings (`key`, `value`) VALUES
('app_name', 'State Fleet Management System'),
('app_version', '1.0.2'),
('maintenance_reminder_days', '7'),
('fuel_alert_threshold', '20'),
('default_currency', 'NGN'),
('timezone', 'Africa/Lagos'),
('max_file_upload_size', '10485760'),
('session_timeout', '3600'),
('backup_frequency', 'daily'),
('email_notifications', 'true'),
('sms_notifications', 'false'),
('auto_backup', 'true'),
('maintenance_interval_km', '5000'),
('fuel_efficiency_tracking', 'true'),
('gps_tracking_interval', '300');

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- ==================================================
-- VERIFICATION QUERIES (Optional - for testing)
-- ==================================================

-- Uncomment these to verify the data was inserted correctly:
-- SELECT COUNT(*) as total_vehicles FROM vehicles;
-- SELECT COUNT(*) as total_drivers FROM drivers;
-- SELECT COUNT(*) as total_maintenance_schedules FROM maintenance_schedules;
-- SELECT COUNT(*) as total_trips FROM trips;
-- SELECT COUNT(*) as total_fuel_records FROM fuel_records;

-- End of complete population script