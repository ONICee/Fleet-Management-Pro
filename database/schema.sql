-- Fleet Management System Database Schema
-- Enterprise Grade Fleet Management

CREATE DATABASE IF NOT EXISTS fleet_management CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fleet_management;

-- Users table for authentication and authorization
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role ENUM('super_admin', 'admin', 'data_entry_officer', 'guest') DEFAULT 'guest',
    phone VARCHAR(20),
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Agencies table for state security and related agencies
CREATE TABLE agencies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    agency_name VARCHAR(100) NOT NULL,
    agency_code VARCHAR(20) UNIQUE NOT NULL,
    agency_type ENUM('federal', 'state', 'local') NOT NULL,
    contact_person VARCHAR(100),
    contact_phone VARCHAR(20),
    contact_email VARCHAR(100),
    headquarters_address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Locations/Deployment areas within the state
CREATE TABLE deployment_locations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    location_name VARCHAR(100) NOT NULL,
    local_government VARCHAR(50),
    senatorial_zone ENUM('north', 'central', 'south'),
    state_zone VARCHAR(50),
    address TEXT,
    coordinates VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vehicles table (Enhanced for state specifications)
CREATE TABLE vehicles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_brand VARCHAR(50) NOT NULL,
    vehicle_model VARCHAR(50) NOT NULL,
    serial_number VARCHAR(30) UNIQUE NOT NULL, -- State-allotted serial number
    year_allotted YEAR NOT NULL,
    year_manufactured YEAR,
    vehicle_type ENUM('land', 'air', 'sea', 'drone', 'motorcycle', 'truck', 'van', 'car', 'bus', 'boat', 'helicopter', 'other') NOT NULL,
    fuel_type ENUM('gasoline', 'diesel', 'electric', 'hybrid', 'jet_fuel', 'battery', 'other') NOT NULL,
    
    -- Vehicle identification details
    engine_number VARCHAR(50),
    chassis_number VARCHAR(50),
    license_plate VARCHAR(15),
    vin VARCHAR(17),
    
    -- Tracker information
    tracker_number VARCHAR(50),
    tracker_imei VARCHAR(20),
    tracker_status ENUM('active', 'inactive', 'not_installed') DEFAULT 'not_installed',
    
    -- Assignment details
    agency_id INT NOT NULL,
    deployment_location_id INT NOT NULL,
    
    -- Serviceability status
    serviceability ENUM('serviceable', 'unserviceable') DEFAULT 'serviceable',
    current_condition TEXT,
    current_mileage INT DEFAULT 0,
    
    -- Purchase/Acquisition details
    purchase_date DATE,
    purchase_price DECIMAL(12,2),
    supplier VARCHAR(100),
    
    -- Maintenance tracking
    last_overhaul DATE NULL,
    next_overhaul DATE NULL,
    last_scheduled_maintenance DATE NULL,
    next_scheduled_maintenance DATE NULL,
    
    -- Insurance and registration
    insurance_policy VARCHAR(50),
    insurance_expiry DATE,
    registration_expiry DATE,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (agency_id) REFERENCES agencies(id),
    FOREIGN KEY (deployment_location_id) REFERENCES deployment_locations(id)
);

-- Drivers table
CREATE TABLE drivers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    license_number VARCHAR(30) UNIQUE NOT NULL,
    license_class VARCHAR(10) NOT NULL,
    license_expiry DATE NOT NULL,
    hire_date DATE NOT NULL,
    emergency_contact_name VARCHAR(100),
    emergency_contact_phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    state VARCHAR(50),
    zip_code VARCHAR(10),
    status ENUM('active', 'inactive', 'suspended', 'on_leave') DEFAULT 'active',
    rating DECIMAL(3,2) DEFAULT 5.00,
    total_trips INT DEFAULT 0,
    total_distance DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Vehicle assignments
CREATE TABLE vehicle_assignments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    driver_id INT NOT NULL,
    assigned_date DATE NOT NULL,
    unassigned_date DATE NULL,
    status ENUM('active', 'completed') DEFAULT 'active',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    FOREIGN KEY (driver_id) REFERENCES drivers(id) ON DELETE CASCADE
);

-- Trips table
CREATE TABLE trips (
    id INT PRIMARY KEY AUTO_INCREMENT,
    trip_number VARCHAR(20) UNIQUE NOT NULL,
    vehicle_id INT NOT NULL,
    driver_id INT NOT NULL,
    route_name VARCHAR(100),
    start_location VARCHAR(200) NOT NULL,
    end_location VARCHAR(200) NOT NULL,
    planned_departure DATETIME NOT NULL,
    planned_arrival DATETIME NOT NULL,
    actual_departure DATETIME NULL,
    actual_arrival DATETIME NULL,
    start_mileage INT,
    end_mileage INT,
    distance_planned DECIMAL(8,2),
    distance_actual DECIMAL(8,2),
    fuel_consumed DECIMAL(8,2),
    status ENUM('planned', 'in_progress', 'completed', 'cancelled', 'delayed') DEFAULT 'planned',
    priority ENUM('low', 'normal', 'high', 'urgent') DEFAULT 'normal',
    cargo_description TEXT,
    cargo_weight DECIMAL(8,2),
    special_instructions TEXT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
    FOREIGN KEY (driver_id) REFERENCES drivers(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Maintenance schedules and records (Enhanced for state specifications)
CREATE TABLE maintenance_schedules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    maintenance_category ENUM('scheduled', 'unscheduled', 'overhaul') NOT NULL,
    maintenance_type VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    scheduled_date DATE NOT NULL,
    mileage_due INT,
    status ENUM('scheduled', 'in_progress', 'completed', 'overdue', 'cancelled') DEFAULT 'scheduled',
    priority ENUM('low', 'normal', 'high', 'critical') DEFAULT 'normal',
    estimated_cost DECIMAL(10,2),
    actual_cost DECIMAL(10,2),
    service_provider VARCHAR(100),
    work_order_number VARCHAR(50),
    parts_replaced TEXT,
    labor_hours DECIMAL(5,2),
    notes TEXT,
    completed_date DATE NULL,
    next_service_date DATE NULL,
    authorized_by INT,
    performed_by VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    FOREIGN KEY (authorized_by) REFERENCES users(id)
);

-- Vehicle maintenance history for detailed tracking
CREATE TABLE maintenance_history (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    maintenance_schedule_id INT,
    maintenance_date DATE NOT NULL,
    maintenance_category ENUM('scheduled', 'unscheduled', 'overhaul') NOT NULL,
    work_performed TEXT NOT NULL,
    parts_used TEXT,
    cost DECIMAL(10,2),
    mileage_at_service INT,
    service_provider VARCHAR(100),
    technician_name VARCHAR(100),
    before_condition TEXT,
    after_condition TEXT,
    warranty_period INT, -- in months
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    FOREIGN KEY (maintenance_schedule_id) REFERENCES maintenance_schedules(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Fuel records
CREATE TABLE fuel_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    driver_id INT NOT NULL,
    fuel_station VARCHAR(100),
    fuel_type ENUM('gasoline', 'diesel', 'electric') NOT NULL,
    quantity DECIMAL(8,2) NOT NULL,
    price_per_unit DECIMAL(6,3) NOT NULL,
    total_cost DECIMAL(10,2) NOT NULL,
    mileage_at_fillup INT NOT NULL,
    receipt_number VARCHAR(50),
    fuel_date DATE NOT NULL,
    location VARCHAR(200),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
    FOREIGN KEY (driver_id) REFERENCES drivers(id)
);

-- Notifications system
CREATE TABLE notifications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('maintenance_due', 'trip_delay', 'vehicle_issue', 'document_expiry', 'fuel_alert', 'system') NOT NULL,
    title VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    priority ENUM('low', 'normal', 'high', 'urgent') DEFAULT 'normal',
    is_read BOOLEAN DEFAULT FALSE,
    action_required BOOLEAN DEFAULT FALSE,
    related_id INT NULL, -- Can reference trips, vehicles, maintenance, etc.
    related_type VARCHAR(50) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    read_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- System logs for audit trail
CREATE TABLE system_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50) NOT NULL,
    entity_id INT NULL,
    old_values JSON NULL,
    new_values JSON NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- User sessions for security
CREATE TABLE user_sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    expires_at TIMESTAMP NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default users and sample data
INSERT INTO users (username, email, password_hash, first_name, last_name, role) VALUES 
('superadmin', 'superadmin@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super', 'Administrator', 'super_admin'),
('admin', 'admin@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', 'admin'),
('dataentry', 'dataentry@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Data Entry', 'Officer', 'data_entry_officer'),
('guest', 'guest@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Guest', 'User', 'guest');

-- Insert sample agencies
INSERT INTO agencies (agency_name, agency_code, agency_type, contact_person, contact_phone, headquarters_address) VALUES 
('State Police Command', 'SPC', 'state', 'Commissioner of Police', '+234-xxx-xxx-xxxx', 'State Police Headquarters'),
('Federal Road Safety Corps', 'FRSC', 'federal', 'Sector Commander', '+234-xxx-xxx-xxxx', 'FRSC State Command'),
('Nigeria Security and Civil Defence Corps', 'NSCDC', 'federal', 'State Commandant', '+234-xxx-xxx-xxxx', 'NSCDC State Command'),
('State Traffic Management Agency', 'STMA', 'state', 'General Manager', '+234-xxx-xxx-xxxx', 'STMA Headquarters'),
('Nigeria Customs Service', 'NCS', 'federal', 'Area Controller', '+234-xxx-xxx-xxxx', 'Customs Area Command'),
('Nigeria Immigration Service', 'NIS', 'federal', 'State Controller', '+234-xxx-xxx-xxxx', 'Immigration State Command'),
('Department of State Services', 'DSS', 'federal', 'State Director', '+234-xxx-xxx-xxxx', 'DSS State Office'),
('Nigeria Police Force Mobile Unit', 'MOPOL', 'federal', 'Unit Commander', '+234-xxx-xxx-xxxx', 'Mobile Police Base');

-- Insert sample deployment locations
INSERT INTO deployment_locations (location_name, local_government, senatorial_zone, state_zone) VALUES 
('State Capital Command', 'Metropolis LGA', 'central', 'Zone A'),
('Northern District Office', 'Northern LGA', 'north', 'Zone B'),
('Southern District Office', 'Southern LGA', 'south', 'Zone C'),
('Eastern Zone Command', 'Eastern LGA', 'central', 'Zone D'),
('Western Zone Command', 'Western LGA', 'central', 'Zone E'),
('Border Patrol Station North', 'Border LGA North', 'north', 'Zone F'),
('Border Patrol Station South', 'Border LGA South', 'south', 'Zone G'),
('Airport Security Unit', 'Airport LGA', 'central', 'Zone H');

-- Create indexes for better performance
CREATE INDEX idx_vehicles_status ON vehicles(status);
CREATE INDEX idx_vehicles_type ON vehicles(vehicle_type);
CREATE INDEX idx_trips_status ON trips(status);
CREATE INDEX idx_trips_dates ON trips(planned_departure, planned_arrival);
CREATE INDEX idx_notifications_user_read ON notifications(user_id, is_read);
CREATE INDEX idx_maintenance_due_date ON maintenance_schedules(scheduled_date, status);
CREATE INDEX idx_fuel_records_date ON fuel_records(fuel_date);
CREATE INDEX idx_system_logs_created ON system_logs(created_at);