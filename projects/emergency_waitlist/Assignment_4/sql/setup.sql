CREATE DATABASE IF NOT EXISTS triage_db;
USE triage_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'patient') NOT NULL
);

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(5) NOT NULL,
    severity INT NOT NULL,
    queue_time INT NOT NULL
);

INSERT INTO users (username, password, role) VALUES ('admin', 'adminpass', 'admin');
