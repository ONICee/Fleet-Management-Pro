-- Additional Maintenance Schedules for Existing Vehicles
-- Use this to add more upcoming maintenance schedules
-- This works with the existing demo vehicles (IDs 1-10)

USE fleet_mgt;

-- ==================================================
-- ADDITIONAL UPCOMING MAINTENANCE SCHEDULES
-- ==================================================

-- Additional upcoming/scheduled maintenance for existing vehicles
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description,
    scheduled_date, mileage_due, status, priority, estimated_cost, service_provider, notes
) VALUES

-- Vehicle 1 (Toyota Camry Police Edition) - Additional services
(1, 'scheduled', 'Oil Service', '25000km oil & filter service', '2025-08-01', 25000, 'scheduled', 'normal', 30000, 'Toyota Service Center', 'Regular 25k service for police vehicle'),
(1, 'scheduled', 'Brake Inspection', 'Brake system inspection and service', '2025-09-15', 27000, 'scheduled', 'high', 65000, 'Toyota Service Center', 'Police vehicle brake safety check'),

-- Vehicle 2 (Toyota Hilux FRSC) - Additional services  
(2, 'scheduled', 'Tire Rotation', 'Tire rotation & balancing', '2025-08-05', 38000, 'scheduled', 'normal', 25000, 'Toyota Service Center', 'Routine tire maintenance for highway patrol'),
(2, 'scheduled', 'Air Filter Service', 'Air filter replacement', '2025-09-20', 40000, 'scheduled', 'normal', 15000, 'Toyota Service Center', 'Dusty conditions require frequent filter changes'),

-- Vehicle 3 (Hyundai Bus NSCDC) - Additional services
(3, 'scheduled', 'General Inspection', 'Annual safety inspection', '2025-07-20', 72000, 'in_progress', 'high', 50000, 'Hyundai Service Center', 'Annual safety inspection for personnel transport'),
(3, 'scheduled', 'AC System Service', 'Air conditioning system maintenance', '2025-08-10', 74000, 'scheduled', 'normal', 85000, 'Auto AC Specialist', 'Bus AC service for passenger comfort'),

-- Vehicle 4 (Honda Motorcycle STMA) - Additional services
(4, 'scheduled', 'Chain Maintenance', 'Chain cleaning and adjustment', '2025-07-15', 6000, 'scheduled', 'normal', 8000, 'Honda Service Center', 'Motorcycle chain service'),
(4, 'scheduled', 'Brake Service', 'Brake pads inspection', '2025-08-30', 7500, 'scheduled', 'normal', 12000, 'Honda Service Center', 'Traffic motorcycle brake safety'),

-- Vehicle 5 (Ford Transit Van NCS) - Additional services
(5, 'scheduled', 'Transmission Service', 'Transmission oil change', '2025-07-25', 32000, 'scheduled', 'normal', 45000, 'Ford Service Center', 'Van transmission maintenance'),
(5, 'scheduled', 'Cooling System', 'Radiator and cooling system service', '2025-09-10', 35000, 'scheduled', 'normal', 35000, 'Ford Service Center', 'Border patrol vehicle cooling service'),

-- Vehicle 6 (Mitsubishi Pajero NIS) - Additional services  
(6, 'scheduled', '4WD System Check', '4WD system inspection and service', '2025-08-15', 82000, 'scheduled', 'high', 75000, 'Mitsubishi Service Center', 'Border operations 4WD maintenance'),
(6, 'scheduled', 'Differential Service', 'Front and rear differential service', '2025-10-01', 85000, 'scheduled', 'normal', 95000, 'Mitsubishi Service Center', 'Off-road vehicle differential maintenance'),

-- Vehicle 7 (Mercedes Sprinter DSS) - Additional services
(7, 'scheduled', 'Electronic Systems', 'Electronic systems diagnostics', '2025-07-30', 52000, 'scheduled', 'high', 85000, 'Mercedes Electronics Service', 'Surveillance equipment integration check'),
(7, 'scheduled', 'Suspension Service', 'Suspension system inspection', '2025-09-25', 55000, 'scheduled', 'normal', 120000, 'Mercedes-Benz Service', 'Van suspension maintenance'),

-- Vehicle 8 (Ford F-350 Armored MOPOL) - Additional services
(8, 'scheduled', 'Armor Inspection', 'Quarterly armor integrity check', '2025-08-20', 108000, 'scheduled', 'critical', 200000, 'Ford Defense Service', 'Armored vehicle safety inspection'),
(8, 'scheduled', 'Communication Systems', 'Radio and communication equipment service', '2025-09-15', 110000, 'scheduled', 'high', 150000, 'Defense Communications', 'Mobile police communication systems'),

-- Vehicle 9 (Land Rover Defender SPC) - Additional services
(9, 'scheduled', 'Off-road Service', 'Off-road capability inspection', '2025-08-25', 38000, 'scheduled', 'normal', 85000, 'Land Rover Service', 'Command vehicle off-road readiness'),
(9, 'scheduled', 'Winch Service', 'Winch system maintenance', '2025-10-15', 42000, 'scheduled', 'normal', 45000, 'Land Rover Service', 'Command vehicle recovery equipment'),

-- Vehicle 10 (Mercedes Ambulance FRSC) - Additional services
(10, 'scheduled', 'Medical Equipment Calibration', 'Quarterly medical equipment check', '2025-07-30', 82000, 'scheduled', 'critical', 125000, 'Medical Equipment Service', 'Life support equipment calibration'),
(10, 'scheduled', 'Emergency Systems Test', 'Siren and emergency lights test', '2025-08-18', 84000, 'scheduled', 'high', 35000, 'Emergency Equipment Service', 'Emergency response systems check');

-- ==================================================
-- OVERDUE MAINTENANCE EXAMPLES (Optional)
-- ==================================================

-- Some overdue maintenance for demonstration
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description,
    scheduled_date, mileage_due, status, priority, estimated_cost, service_provider, notes
) VALUES

-- Overdue examples
(2, 'unscheduled', 'Engine Diagnostics', 'Engine warning light investigation', '2025-06-15', 36000, 'overdue', 'critical', 75000, 'Toyota Service Center', 'Check engine light - urgent'),
(5, 'scheduled', 'Battery Replacement', 'Van battery replacement', '2025-06-20', 30000, 'overdue', 'high', 25000, 'Auto Parts Center', 'Battery showing signs of failure'),
(7, 'scheduled', 'Fuel System Service', 'Fuel filter and pump inspection', '2025-06-25', 50000, 'overdue', 'normal', 40000, 'Mercedes-Benz Service', 'Scheduled fuel system maintenance');

-- End of additional maintenance schedules