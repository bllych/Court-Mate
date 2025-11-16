# CourtMate Database Integration TODO

## Database Setup
- [x] Create config.php for database connection
- [x] Create db.php with database functions (CRUD for all tables)
- [x] Run SQL script to create database and tables
- [x] Populate database with sample data

## Authentication & User Management
- [x] Create login.php for user authentication
- [x] Create signup.php for user registration
- [x] Update Account/index.php to use DB authentication
- [x] Update Isi/Amos/Users-page.php to display user data from DB

## Court Management
- [x] Update index.php to fetch and display courts from DB
- [ ] Update Isi/Pemesanan.php to show court details from DB
- [ ] Create booking.php for court booking functionality

## Coach Management
- [ ] Update Isi/Coaching.php to display coaches from DB
- [ ] Update Isi/Amot.php and Isi/Silvio.php to show coach details from DB
- [ ] Create coach_booking.php for coach booking functionality

## Payment Processing
- [ ] Update Isi/Payment Lapangan.php to process court bookings
- [ ] Update Isi/Payment Coach Amos.php and Isi/Payment Coach Silvio.php to process coach bookings
- [ ] Create payment_process.php for payment handling

## Admin Panel Updates
- [ ] Update Isi/Amos/Admin-page.php with dynamic stats from DB
- [ ] Update Isi/Amos/Admin-user.php with user CRUD operations
- [ ] Update Isi/Amos/Admin-court.php with court CRUD operations
- [ ] Update Isi/Amos/Admin-coach.php with coach CRUD operations
- [ ] Update Isi/Amos/Admin-rate.php with review management

## Review System
- [ ] Add review submission functionality to booking pages
- [ ] Display reviews on court/coach detail pages

## Testing
- [ ] Test all pages for database connectivity
- [ ] Test CRUD operations
- [ ] Test booking and payment flows
- [ ] Test admin panel functionality
