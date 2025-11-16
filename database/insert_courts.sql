USE court_mate_db;

-- Sample Users (skip if exists)
INSERT IGNORE INTO users (name, email, phone, password, role) VALUES
('Admin', 'admin@court-mate.com', '08123456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('John Doe', 'john@example.com', '08123456780', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
('Jane Smith', 'jane@example.com', '08123456781', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Sample Courts
INSERT INTO courts (court_name, location, price_per_hour, description, image) VALUES
('Lapangan Basket Indoor A', 'Pontianak', 150000.00, 'Lapangan basket indoor dengan fasilitas lengkap.', 'Gambar/Pemesanan/169115254274527.image_cropper_1691152512433 1.png'),
('Lapangan Basket Outdoor B', 'Singkawang', 100000.00, 'Lapangan basket outdoor di area terbuka.', 'Gambar/Pemesanan/169115254345379.image_cropper_1691152402100 1.png'),
('Lapangan Basket Semi-Outdoor C', 'Ketapang', 120000.00, 'Lapangan semi-outdoor dengan atap.', 'Gambar/Pemesanan/image 20.png'),
('Lapangan Basket Halfcourt D', 'Sambas', 80000.00, 'Halfcourt untuk latihan intensif.', 'Gambar/Gambar Home/image 20-1.png'),
('Lapangan Basket Indoor E', 'Mempawah', 180000.00, 'Lapangan indoor premium dengan AC.', 'Gambar/Gambar Home/image 20-2.png'),
('Lapangan Basket Outdoor F', 'Bengkayang', 95000.00, 'Lapangan outdoor dengan pemandangan indah.', 'Gambar/Gambar Home/image 20-3.png');

-- Sample Coaches
INSERT INTO coaches (coach_name, experience_years, specialty, price_per_hour, description, image) VALUES
('Coach Amos', 5, 'Shooting', 200000.00, 'Expert in shooting techniques.', 'Gambar/Coach/1.png'),
('Coach Silvio', 8, 'Defense', 250000.00, 'Specialist in defensive strategies.', 'Gambar/Coach/2.png'),
('Coach Alex', 3, 'Dribbling', 180000.00, 'Focus on dribbling skills.', 'Gambar/Coach/3.png');

-- Sample Court Bookings (using existing user_ids 5 and 6)
INSERT INTO court_booking (user_id, court_id, booking_date, start_time, end_time, total_price, status) VALUES
(5, 1, '2023-10-01', '10:00:00', '12:00:00', 300000.00, 'confirmed'),
(6, 2, '2023-10-02', '14:00:00', '16:00:00', 200000.00, 'pending');

-- Sample Coach Bookings
INSERT INTO coach_booking (user_id, coach_id, booking_date, start_time, end_time, total_price, status) VALUES
(5, 1, '2023-10-03', '09:00:00', '11:00:00', 400000.00, 'confirmed'),
(6, 2, '2023-10-04', '13:00:00', '15:00:00', 500000.00, 'pending');

-- Sample Payments
INSERT INTO payments (user_id, type, booking_id, amount, payment_method, payment_status) VALUES
(5, 'court', 1, 300000.00, 'ewallet', 'paid'),
(6, 'coach', 1, 400000.00, 'bank_transfer', 'pending');

-- Sample Reviews
INSERT INTO reviews (user_id, type, item_id, rating, comment) VALUES
(5, 'court', 1, 5, 'Great court!'),
(6, 'coach', 1, 4, 'Good coaching session.');
