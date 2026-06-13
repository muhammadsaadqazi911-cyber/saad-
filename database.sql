-- Run this file in phpMyAdmin or MySQL CLI to create the database and table

CREATE DATABASE IF NOT EXISTS hostel_db;
USE hostel_db;

CREATE TABLE IF NOT EXISTS rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(10) NOT NULL,
    block VARCHAR(20) NOT NULL,
    capacity INT NOT NULL,
    occupied INT NOT NULL,
    monthly_fee DECIMAL(10,2) NOT NULL,
    added_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data (optional)
INSERT INTO rooms (room_number, block, capacity, occupied, monthly_fee) VALUES
('101', 'A', 2, 1, 8000.00),
('102', 'A', 3, 3, 7000.00),
('201', 'B', 2, 0, 8500.00);
