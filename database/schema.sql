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
    role ENUM('admin', 'manager', 'dispatcher', 'driver') DEFAULT 'driver',
    phone VARCHAR(20),
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Vehicles table
CREATE TABLE vehicles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_number VARCHAR(20) UNIQUE NOT NULL,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year YEAR NOT NULL,
    vin VARCHAR(17) UNIQUE,
    license_plate VARCHAR(15) UNIQUE NOT NULL,
    vehicle_type ENUM('truck', 'van', 'car', 'motorcycle', 'bus') NOT NULL,
    fuel_type ENUM('gasoline', 'diesel', 'electric', 'hybrid') NOT NULL,
    capacity_weight DECIMAL(8,2),
    capacity_volume DECIMAL(8,2),
    purchase_date DATE,
    purchase_price DECIMAL(12,2),
    current_mileage INT DEFAULT 0,
    status ENUM('active', 'maintenance', 'retired', 'accident') DEFAULT 'active',
    gps_device_id VARCHAR(50),
    insurance_policy VARCHAR(50),
    insurance_expiry DATE,
    registration_expiry DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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

-- Maintenance schedules and records
CREATE TABLE maintenance_schedules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    vehicle_id INT NOT NULL,
    maintenance_type ENUM('oil_change', 'tire_rotation', 'brake_check', 'engine_tune', 'inspection', 'other') NOT NULL,
    description TEXT NOT NULL,
    scheduled_date DATE NOT NULL,
    mileage_due INT,
    status ENUM('scheduled', 'in_progress', 'completed', 'overdue', 'cancelled') DEFAULT 'scheduled',
    priority ENUM('low', 'normal', 'high', 'critical') DEFAULT 'normal',
    estimated_cost DECIMAL(10,2),
    actual_cost DECIMAL(10,2),
    service_provider VARCHAR(100),
    notes TEXT,
    completed_date DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
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

-- Insert default admin user
INSERT INTO users (username, email, password_hash, first_name, last_name, role) VALUES 
('admin', 'admin@fleetmanagement.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', 'admin');

-- Create indexes for better performance
CREATE INDEX idx_vehicles_status ON vehicles(status);
CREATE INDEX idx_vehicles_type ON vehicles(vehicle_type);
CREATE INDEX idx_trips_status ON trips(status);
CREATE INDEX idx_trips_dates ON trips(planned_departure, planned_arrival);
CREATE INDEX idx_notifications_user_read ON notifications(user_id, is_read);
CREATE INDEX idx_maintenance_due_date ON maintenance_schedules(scheduled_date, status);
CREATE INDEX idx_fuel_records_date ON fuel_records(fuel_date);
CREATE INDEX idx_system_logs_created ON system_logs(created_at);