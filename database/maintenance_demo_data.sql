-- Demo Maintenance Data aligned with sample_vehicle_data.sql
-- IMPORT AFTER sample_vehicle_data.sql has been loaded
USE fleet_mgt;

-- Upcoming / scheduled
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description,
    scheduled_date, mileage_due, status, priority, estimated_cost, service_provider, notes
) VALUES
(16,'scheduled','Oil Service','5k oil & filter','2025-08-01',20000,'scheduled','normal',30000,'Toyota Service','First service for Hilux'),
(17,'scheduled','Tire Rotation','Rotation & balancing','2025-08-05',30000,'scheduled','normal',15000,'Toyota Service','Routine'),
(18,'scheduled','Inspection','General inspection','2025-07-20',14000,'in_progress','high',50000,'Ford Nigeria','Annual safety inspection');

-- Overdue example
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description,
    scheduled_date, mileage_due, status, priority, estimated_cost
) VALUES
(19,'unscheduled','Engine Repair','Engine diagnostics & repair','2025-06-15',48000,'overdue','critical',250000);

-- Completed schedule & matching history
INSERT INTO maintenance_schedules (
    vehicle_id, maintenance_category, maintenance_type, description,
    scheduled_date, mileage_due, status, priority, estimated_cost, actual_cost, completed_date
) VALUES
(20,'scheduled','Small Service','Oil + air filter','2025-07-01',15000,'completed','normal',28000,26500,'2025-07-02');
SET @sched_id = LAST_INSERT_ID();
INSERT INTO maintenance_history (
    vehicle_id, maintenance_schedule_id, maintenance_date, maintenance_category, work_performed, cost
) VALUES
(20,@sched_id,'2025-07-02','scheduled','Oil & filter changed',26500);

-- basic system log entries for maintenance
INSERT INTO system_logs (user_id,action,entity_type,entity_id,ip_address) VALUES
(1,'create','maintenance_schedule',@sched_id,'127.0.0.1'),
(1,'complete','maintenance',@sched_id,'127.0.0.1');