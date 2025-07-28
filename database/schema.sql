-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 03:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet_mgt`
--

CREATE DATABASE IF NOT EXISTS fleet_mgt CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fleet_mgt;

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id` int(11) NOT NULL,
  `agency_name` varchar(100) NOT NULL,
  `agency_code` varchar(20) NOT NULL,
  `agency_type` enum('federal','state','local') NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `headquarters_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`id`, `agency_name`, `agency_code`, `agency_type`, `contact_person`, `contact_phone`, `contact_email`, `headquarters_address`, `created_at`, `updated_at`) VALUES
(1, 'State Police Command', 'SPC', 'state', 'Commissioner of Police', '+234-xxx-xxx-xxxx', NULL, 'State Police Headquarters', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(2, 'Federal Road Safety Corps', 'FRSC', 'federal', 'Sector Commander', '+234-xxx-xxx-xxxx', NULL, 'FRSC State Command', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(3, 'Nigeria Security and Civil Defence Corps', 'NSCDC', 'federal', 'State Commandant', '+234-xxx-xxx-xxxx', NULL, 'NSCDC State Command', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(4, 'State Traffic Management Agency', 'STMA', 'state', 'General Manager', '+234-xxx-xxx-xxxx', NULL, 'STMA Headquarters', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(5, 'Nigeria Customs Service', 'NCS', 'federal', 'Area Controller', '+234-xxx-xxx-xxxx', NULL, 'Customs Area Command', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(6, 'Nigeria Immigration Service', 'NIS', 'federal', 'State Controller', '+234-xxx-xxx-xxxx', NULL, 'Immigration State Command', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(7, 'Department of State Services', 'DSS', 'federal', 'State Director', '+234-xxx-xxx-xxxx', NULL, 'DSS State Office', '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(8, 'Nigeria Police Force Mobile Unit', 'MOPOL', 'federal', 'Unit Commander', '+234-xxx-xxx-xxxx', NULL, 'Mobile Police Base', '2025-07-27 13:51:29', '2025-07-27 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `deployment_locations`
--

CREATE TABLE `deployment_locations` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `local_government` varchar(50) DEFAULT NULL,
  `senatorial_zone` enum('north','central','south') DEFAULT NULL,
  `state_zone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `coordinates` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deployment_locations`
--

INSERT INTO `deployment_locations` (`id`, `location_name`, `local_government`, `senatorial_zone`, `state_zone`, `address`, `coordinates`, `created_at`) VALUES
(1, 'State Capital Command', 'Metropolis LGA', 'central', 'Zone A', NULL, NULL, '2025-07-27 13:51:29'),
(2, 'Northern District Office', 'Northern LGA', 'north', 'Zone B', NULL, NULL, '2025-07-27 13:51:29'),
(3, 'Southern District Office', 'Southern LGA', 'south', 'Zone C', NULL, NULL, '2025-07-27 13:51:29'),
(4, 'Eastern Zone Command', 'Eastern LGA', 'central', 'Zone D', NULL, NULL, '2025-07-27 13:51:29'),
(5, 'Western Zone Command', 'Western LGA', 'central', 'Zone E', NULL, NULL, '2025-07-27 13:51:29'),
(6, 'Border Patrol Station North', 'Border LGA North', 'north', 'Zone F', NULL, NULL, '2025-07-27 13:51:29'),
(7, 'Border Patrol Station South', 'Border LGA South', 'south', 'Zone G', NULL, NULL, '2025-07-27 13:51:29'),
(8, 'Airport Security Unit', 'Airport LGA', 'central', 'Zone H', NULL, NULL, '2025-07-27 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `license_number` varchar(30) NOT NULL,
  `license_class` varchar(10) NOT NULL,
  `license_expiry` date NOT NULL,
  `hire_date` date NOT NULL,
  `emergency_contact_name` varchar(100) DEFAULT NULL,
  `emergency_contact_phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `status` enum('active','inactive','suspended','on_leave') DEFAULT 'active',
  `rating` decimal(3,2) DEFAULT 5.00,
  `total_trips` int(11) DEFAULT 0,
  `total_distance` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_records`
--

CREATE TABLE `fuel_records` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `fuel_station` varchar(100) DEFAULT NULL,
  `fuel_type` enum('gasoline','diesel','electric') NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `price_per_unit` decimal(6,3) NOT NULL,
  `total_cost` decimal(10,2) NOT NULL,
  `mileage_at_fillup` int(11) NOT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `fuel_date` date NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_history`
--

CREATE TABLE `maintenance_history` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `maintenance_schedule_id` int(11) DEFAULT NULL,
  `maintenance_date` date NOT NULL,
  `maintenance_category` enum('scheduled','unscheduled','overhaul') NOT NULL,
  `work_performed` text NOT NULL,
  `parts_used` text DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `mileage_at_service` int(11) DEFAULT NULL,
  `service_provider` varchar(100) DEFAULT NULL,
  `technician_name` varchar(100) DEFAULT NULL,
  `before_condition` text DEFAULT NULL,
  `after_condition` text DEFAULT NULL,
  `warranty_period` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_schedules`
--

CREATE TABLE `maintenance_schedules` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `maintenance_category` enum('scheduled','unscheduled','overhaul') NOT NULL,
  `maintenance_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `scheduled_date` date NOT NULL,
  `mileage_due` int(11) DEFAULT NULL,
  `status` enum('scheduled','in_progress','completed','overdue','cancelled') DEFAULT 'scheduled',
  `priority` enum('low','normal','high','critical') DEFAULT 'normal',
  `estimated_cost` decimal(10,2) DEFAULT NULL,
  `actual_cost` decimal(10,2) DEFAULT NULL,
  `service_provider` varchar(100) DEFAULT NULL,
  `work_order_number` varchar(50) DEFAULT NULL,
  `parts_replaced` text DEFAULT NULL,
  `labor_hours` decimal(5,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `next_service_date` date DEFAULT NULL,
  `authorized_by` int(11) DEFAULT NULL,
  `performed_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('maintenance_due','trip_delay','vehicle_issue','document_expiry','fuel_alert','system') NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `priority` enum('low','normal','high','urgent') DEFAULT 'normal',
  `is_read` tinyint(1) DEFAULT 0,
  `action_required` tinyint(1) DEFAULT 0,
  `related_id` int(11) DEFAULT NULL,
  `related_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) NOT NULL,
  `entity_type` varchar(50) NOT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `old_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `new_values` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `id` int(11) NOT NULL,
  `trip_number` varchar(20) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `route_name` varchar(100) DEFAULT NULL,
  `start_location` varchar(200) NOT NULL,
  `end_location` varchar(200) NOT NULL,
  `planned_departure` datetime NOT NULL,
  `planned_arrival` datetime NOT NULL,
  `actual_departure` datetime DEFAULT NULL,
  `actual_arrival` datetime DEFAULT NULL,
  `start_mileage` int(11) DEFAULT NULL,
  `end_mileage` int(11) DEFAULT NULL,
  `distance_planned` decimal(8,2) DEFAULT NULL,
  `distance_actual` decimal(8,2) DEFAULT NULL,
  `fuel_consumed` decimal(8,2) DEFAULT NULL,
  `status` enum('planned','in_progress','completed','cancelled','delayed') DEFAULT 'planned',
  `priority` enum('low','normal','high','urgent') DEFAULT 'normal',
  `cargo_description` text DEFAULT NULL,
  `cargo_weight` decimal(8,2) DEFAULT NULL,
  `special_instructions` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('super_admin','admin','data_entry_officer','guest') DEFAULT 'guest',
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('active','inactive','suspended') DEFAULT 'active',
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `first_name`, `last_name`, `role`, `phone`, `status`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'superadmin@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super', 'Administrator', 'super_admin', NULL, 'active', NULL, '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(2, 'admin', 'admin@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System', 'Administrator', 'admin', NULL, 'active', NULL, '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(3, 'dataentry', 'dataentry@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Data Entry', 'Officer', 'data_entry_officer', NULL, 'active', NULL, '2025-07-27 13:51:29', '2025-07-27 13:51:29'),
(4, 'guest', 'guest@statefleet.gov', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Guest', 'User', 'guest', NULL, 'active', NULL, '2025-07-27 13:51:29', '2025-07-27 13:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_brand` varchar(50) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `serial_number` varchar(30) NOT NULL,
  `year_allotted` year(4) NOT NULL,
  `year_manufactured` year(4) DEFAULT NULL,
  `vehicle_type` enum('land','air','sea','drone','motorcycle','truck','van','car','bus','boat','helicopter','other') NOT NULL,
  `fuel_type` enum('gasoline','diesel','electric','hybrid','jet_fuel','battery','other') NOT NULL,
  `engine_number` varchar(50) DEFAULT NULL,
  `chassis_number` varchar(50) DEFAULT NULL,
  `license_plate` varchar(15) DEFAULT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `tracker_number` varchar(50) DEFAULT NULL,
  `tracker_imei` varchar(20) DEFAULT NULL,
  `tracker_status` enum('active','inactive','not_installed') DEFAULT 'not_installed',
  `agency_id` int(11) NOT NULL,
  `deployment_location_id` int(11) NOT NULL,
  `serviceability` enum('serviceable','unserviceable') DEFAULT 'serviceable',
  `current_condition` text DEFAULT NULL,
  `current_mileage` int(11) DEFAULT 0,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` decimal(12,2) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `last_overhaul` date DEFAULT NULL,
  `next_overhaul` date DEFAULT NULL,
  `last_scheduled_maintenance` date DEFAULT NULL,
  `next_scheduled_maintenance` date DEFAULT NULL,
  `insurance_policy` varchar(50) DEFAULT NULL,
  `insurance_expiry` date DEFAULT NULL,
  `registration_expiry` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive','maintenance','decommissioned') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_assignments`
--

CREATE TABLE `vehicle_assignments` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `assigned_date` date NOT NULL,
  `unassigned_date` date DEFAULT NULL,
  `status` enum('active','completed') DEFAULT 'active',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agency_code` (`agency_code`);

--
-- Indexes for table `deployment_locations`
--
ALTER TABLE `deployment_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `license_number` (`license_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fuel_records`
--
ALTER TABLE `fuel_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `maintenance_history`
--
ALTER TABLE `maintenance_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `maintenance_schedule_id` (`maintenance_schedule_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `maintenance_schedules`
--
ALTER TABLE `maintenance_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `authorized_by` (`authorized_by`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trip_number` (`trip_number`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `agency_id` (`agency_id`),
  ADD KEY `deployment_location_id` (`deployment_location_id`),
  ADD KEY `idx_vehicles_status` (`status`);

--
-- Indexes for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `deployment_locations`
--
ALTER TABLE `deployment_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_records`
--
ALTER TABLE `fuel_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_history`
--
ALTER TABLE `maintenance_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_schedules`
--
ALTER TABLE `maintenance_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuel_records`
--
ALTER TABLE `fuel_records`
  ADD CONSTRAINT `fuel_records_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `fuel_records_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `maintenance_history`
--
ALTER TABLE `maintenance_history`
  ADD CONSTRAINT `maintenance_history_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_history_ibfk_2` FOREIGN KEY (`maintenance_schedule_id`) REFERENCES `maintenance_schedules` (`id`),
  ADD CONSTRAINT `maintenance_history_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `maintenance_schedules`
--
ALTER TABLE `maintenance_schedules`
  ADD CONSTRAINT `maintenance_schedules_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `maintenance_schedules_ibfk_2` FOREIGN KEY (`authorized_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD CONSTRAINT `system_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `trips`
--
ALTER TABLE `trips`
  ADD CONSTRAINT `trips_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `trips_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`),
  ADD CONSTRAINT `trips_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`id`),
  ADD CONSTRAINT `vehicles_ibfk_2` FOREIGN KEY (`deployment_location_id`) REFERENCES `deployment_locations` (`id`);

--
-- Constraints for table `vehicle_assignments`
--
ALTER TABLE `vehicle_assignments`
  ADD CONSTRAINT `vehicle_assignments_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicle_assignments_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;