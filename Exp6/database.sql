-- Step 1: Create the database
CREATE DATABASE IF NOT EXISTS wpl_lab;

-- Step 2: Use the database
USE wpl_lab;

-- Step 3: Create the table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    branch VARCHAR(50) NOT NULL
);

-- Optional: Insert dummy data
INSERT INTO students (name, email, branch) VALUES 
('John Doe', 'john@example.com', 'Computer Engineering'),
('Jane Smith', 'jane@example.com', 'Information Technology');
