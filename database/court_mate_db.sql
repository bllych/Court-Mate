-- Create database
CREATE DATABASE IF NOT EXISTS court_mate_db;
USE court_mate_db;

-------------------------
-- USERS (Login/Signup)
-------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-------------------------
-- COURTS (Daftar Lapangan)
-------------------------
CREATE TABLE courts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    court_name VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    price_per_hour DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-------------------------
-- COURT BOOKINGS (Pemesanan Lapangan)
-------------------------
CREATE TABLE court_booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    court_id INT NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (court_id) REFERENCES courts(id)
);

-------------------------
-- COACHES (Daftar Pelatih)
-------------------------
CREATE TABLE coaches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_name VARCHAR(100) NOT NULL,
    experience_years INT NOT NULL,
    specialty VARCHAR(100),
    price_per_hour DECIMAL(10,2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-------------------------
-- COACH BOOKINGS (Pemesanan Coach)
-------------------------
CREATE TABLE coach_booking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    coach_id INT NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (coach_id) REFERENCES coaches(id)
);

-------------------------
-- PAYMENTS (Semua Transaksi)
-------------------------
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('court','coach') NOT NULL,
    booking_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('bank_transfer','ewallet','cash') NOT NULL,
    payment_status ENUM('pending','paid','failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-------------------------
-- REVIEWS (Rating Lapangan & Coach)
-------------------------
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    type ENUM('court','coach') NOT NULL,
    item_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
