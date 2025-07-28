-- Fix for user_sessions table timestamp issue
-- Run this if you encountered the #1067 error during initial installation
-- Database: fleet_mgt

USE fleet_mgt;

-- Drop the problematic table if it exists
DROP TABLE IF EXISTS user_sessions;

-- Recreate the user_sessions table with correct column definitions
CREATE TABLE user_sessions (
    id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_activity TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    expires_at DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create index for better performance
CREATE INDEX idx_user_sessions_user_id ON user_sessions(user_id);
CREATE INDEX idx_user_sessions_expires ON user_sessions(expires_at);

-- Display success message
SELECT 'user_sessions table fixed successfully!' AS Status;