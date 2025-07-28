-- Fleet Management Pro Full Demo Dump
-- Compatible with MariaDB 10.4 / MySQL 8
-- IMPORT with:  mysql -u root -p < database/full_demo_dump.sql

SET @@FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
DROP DATABASE IF EXISTS fleet_mgt;
CREATE DATABASE fleet_mgt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fleet_mgt;

-- ----------------------------
-- 1. Core reference tables
-- ----------------------------
CREATE TABLE agencies (
  id INT AUTO_INCREMENT PRIMARY KEY,
  agency_name VARCHAR(100) NOT NULL,
  agency_code VARCHAR(20) NOT NULL UNIQUE,
  agency_type ENUM('federal','state','local') NOT NULL,
  contact_person VARCHAR(100),
  contact_phone VARCHAR(20),
  contact_email VARCHAR(100),
  headquarters_address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE deployment_locations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  location_name VARCHAR(100) NOT NULL,
  local_government VARCHAR(50),
  senatorial_zone ENUM('north','central','south'),
  state_zone VARCHAR(50),
  address TEXT,
  coordinates VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  role ENUM('super_admin','admin','data_entry_officer','guest') DEFAULT 'guest',
  phone VARCHAR(20),
  status ENUM('active','inactive','suspended') DEFAULT 'active',
  last_login TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE drivers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  license_number VARCHAR(30) UNIQUE NOT NULL,
  license_class VARCHAR(10) NOT NULL,
  license_expiry DATE NOT NULL,
  hire_date DATE NOT NULL,
  status ENUM('active','inactive','suspended','on_leave') DEFAULT 'active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ----------------------------
-- 2. Fleet tables
-- ----------------------------
CREATE TABLE vehicles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_brand VARCHAR(50) NOT NULL,
  vehicle_model VARCHAR(50) NOT NULL,
  serial_number VARCHAR(30) UNIQUE NOT NULL,
  year_allotted YEAR NOT NULL,
  vehicle_type ENUM('car','truck','van','bus','motorcycle','boat','drone','other') NOT NULL,
  fuel_type ENUM('gasoline','diesel','electric','hybrid','battery','other') NOT NULL,
  tracker_status ENUM('active','inactive','not_installed') DEFAULT 'not_installed',
  agency_id INT NOT NULL,
  deployment_location_id INT NOT NULL,
  serviceability ENUM('serviceable','unserviceable') DEFAULT 'serviceable',
  current_mileage INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('active','maintenance','decommissioned') DEFAULT 'active',
  current_lat DECIMAL(10,7),
  current_lng DECIMAL(10,7),
  last_fix_at TIMESTAMP NULL
) ENGINE=InnoDB;

CREATE TABLE fuel_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT NOT NULL,
  driver_id INT,
  fuel_station VARCHAR(100),
  fuel_type ENUM('gasoline','diesel','electric') NOT NULL,
  quantity DECIMAL(8,2) NOT NULL,
  price_per_unit DECIMAL(6,3) NOT NULL,
  total_cost DECIMAL(10,2) NOT NULL,
  fuel_date DATE NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE maintenance_schedules (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT NOT NULL,
  maintenance_category ENUM('scheduled','unscheduled','overhaul') NOT NULL,
  maintenance_type VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  scheduled_date DATE NOT NULL,
  status ENUM('scheduled','in_progress','completed','overdue','cancelled') DEFAULT 'scheduled',
  priority ENUM('low','normal','high','critical') DEFAULT 'normal',
  estimated_cost DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE maintenance_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  vehicle_id INT NOT NULL,
  maintenance_schedule_id INT,
  maintenance_date DATE NOT NULL,
  maintenance_category ENUM('scheduled','unscheduled','overhaul') NOT NULL,
  work_performed TEXT NOT NULL,
  cost DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE system_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action VARCHAR(100) NOT NULL,
  entity_type VARCHAR(50) NOT NULL,
  entity_id INT,
  ip_address VARCHAR(45),
  user_agent TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ----------------------------
-- 3. Seed data (agencies, locations, users, vehicles ...)
-- ----------------------------
INSERT INTO agencies (agency_name, agency_code, agency_type) VALUES
('State Police Command','SPC','state'),
('Federal Road Safety Corps','FRSC','federal');
INSERT INTO deployment_locations (location_name, senatorial_zone) VALUES
('State Capital Command','central'),
('Northern District','north');

-- super admin + driver users
INSERT INTO users (username,email,password_hash,first_name,last_name,role) VALUES
('superadmin','super@localhost','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','Super','Admin','super_admin'),
('driver1','driver1@localhost','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','John','Doe','data_entry_officer');

INSERT INTO drivers (user_id,license_number,license_class,license_expiry,hire_date) VALUES
(2,'LIC123','B','2026-12-31','2024-01-01');

INSERT INTO vehicles (vehicle_brand,vehicle_model,serial_number,year_allotted,vehicle_type,fuel_type,tracker_status,agency_id,deployment_location_id) VALUES
('Toyota','Hilux','SPC-001-24',2024,'truck','diesel','active',1,1),
('Toyota','Corolla','SPC-002-23',2023,'car','gasoline','active',1,1);

-- Fuel for both vehicles
INSERT INTO fuel_records (vehicle_id,driver_id,fuel_station,fuel_type,quantity,price_per_unit,total_cost,fuel_date) VALUES
(1,1,'Conoil','diesel',60,650,39000,'2025-07-01'),
(2,1,'Total','gasoline',45,570,25650,'2025-07-02');

-- Maintenance schedule & history
INSERT INTO maintenance_schedules (vehicle_id,maintenance_category,maintenance_type,description,scheduled_date,estimated_cost) VALUES
(1,'scheduled','Oil Change','Regular 5k oil service','2025-08-01',30000),
(2,'unscheduled','Brake Pads','Front pads worn','2025-07-15',45000);

INSERT INTO maintenance_history (vehicle_id,maintenance_schedule_id,maintenance_date,maintenance_category,work_performed,cost) VALUES
(1,1,'2025-02-01','scheduled','Oil & filter changed',28000);

-- system logs
INSERT INTO system_logs (user_id,action,entity_type,entity_id,ip_address) VALUES
(1,'create','vehicle',1,'127.0.0.1'),
(1,'create','maintenance_schedule',1,'127.0.0.1');

-- ----------------------------
-- 4. Foreign keys (added after seeding to avoid circular issues)
-- ----------------------------
ALTER TABLE vehicles ADD CONSTRAINT fk_veh_agency FOREIGN KEY (agency_id) REFERENCES agencies(id),
                        ADD CONSTRAINT fk_veh_loc FOREIGN KEY (deployment_location_id) REFERENCES deployment_locations(id);
ALTER TABLE drivers  ADD CONSTRAINT fk_driver_user FOREIGN KEY (user_id) REFERENCES users(id);
ALTER TABLE fuel_records ADD FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
                          ADD FOREIGN KEY (driver_id) REFERENCES drivers(id);
ALTER TABLE maintenance_schedules ADD FOREIGN KEY (vehicle_id) REFERENCES vehicles(id);
ALTER TABLE maintenance_history  ADD FOREIGN KEY (vehicle_id) REFERENCES vehicles(id),
                                 ADD FOREIGN KEY (maintenance_schedule_id) REFERENCES maintenance_schedules(id);
ALTER TABLE system_logs ADD FOREIGN KEY (user_id) REFERENCES users(id);

SET @@FOREIGN_KEY_CHECKS = 1;

-- End of full demo dump