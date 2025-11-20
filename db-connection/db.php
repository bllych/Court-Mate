<?php
require_once 'config.php';

/* ============================================================
   USER FUNCTIONS
   ============================================================ */

function getUserById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function getUserByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createUser($name, $email, $phone, $password, $role = 'user') {
    global $conn;
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare(
        "INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssss", $name, $email, $phone, $hashed, $role);
    return $stmt->execute();
}
function updateUser($name, $email, $phone, $id) {
    global $conn;
    $stmt = $conn->prepare(
        "UPDATE users SET name = ?, email = ?, phone = ? WHERE id = ?"
    );
    $stmt->bind_param("sssi", $name, $email, $phone, $id);
    return $stmt->execute();
}

function deleteUser($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function getAllUsers() {
    global $conn;
    $sql = "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllUsers: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}


/* ============================================================
   COURTS
   ============================================================ */

function getAllCourts() {
    global $conn;
    $sql = "SELECT * FROM courts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllCourts: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCourtById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM courts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createCourt($court_name, $location, $price, $description, $image) {
    global $conn;
    $stmt = $conn->prepare(
        "INSERT INTO courts (court_name, location, price_per_hour, description, image)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssdss", $court_name, $location, $price, $description, $image);
    return $stmt->execute();
}

function updateCourt($id, $court_name, $location, $price, $description, $image) {
    global $conn;
    $stmt = $conn->prepare(
        "UPDATE courts SET court_name=?, location=?, price_per_hour=?,
        description=?, image=? WHERE id=?"
    );
    $stmt->bind_param("ssdssi", $court_name, $location, $price, $description, $image, $id);
    return $stmt->execute();
}

function deleteCourt($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM courts WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


/* ============================================================
   COURT BOOKING
   ============================================================ */

function createCourtBooking($user_id, $court_id, $date, $start, $end, $total) {
    global $conn;
    $stmt = $conn->prepare(
        "INSERT INTO court_booking (user_id, court_id, booking_date, start_time, end_time, total_price)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("iisssd", $user_id, $court_id, $date, $start, $end, $total);
    return $stmt->execute();
}

function getCourtBookingsByUser($user_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT cb.*, c.court_name, c.location
         FROM court_booking cb
         JOIN courts c ON cb.court_id = c.id
         WHERE cb.user_id = ?
         ORDER BY cb.created_at DESC"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function getAllCourtBookings() {
    global $conn;
    $sql =
    "SELECT cb.*, u.name as user_name, c.court_name
     FROM court_booking cb
     JOIN users u ON cb.user_id = u.id
     JOIN courts c ON cb.court_id = c.id
     ORDER BY cb.created_at DESC";

    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllCourtBookings: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateCourtBookingStatus($id, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE court_booking SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    return $stmt->execute();
}


/* ============================================================
   COACHES
   ============================================================ */

function getAllCoaches() {
    global $conn;
    $sql = "SELECT * FROM coaches ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllCoaches: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function getCoachById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM coaches WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createCoach($name, $exp, $specialty, $price, $desc, $image) {
    global $conn;

    // CONVERT jenis data → penting supaya tidak error
    $exp   = intval($exp);       // integer
    $price = floatval($price);   // double untuk decimal

    $stmt = $conn->prepare(
        "INSERT INTO coaches (coach_name, experience_years, specialty, price_per_hour, description, image)
         VALUES (?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die("SQL PREPARE ERROR (createCoach): " . $conn->error);
    }

    if (!$stmt->bind_param("sisdss", $name, $exp, $specialty, $price, $desc, $image)) {
        die("BIND ERROR (createCoach): " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("EXECUTE ERROR (createCoach): " . $stmt->error);
    }

    return true;
}

function updateCoach($id, $name, $exp, $specialty, $price, $desc, $image) {
    global $conn;
    $stmt = $conn->prepare(
        "UPDATE coaches SET coach_name=?, experience_years=?, specialty=?,
        price_per_hour=?, description=?, image=? WHERE id=?"
    );
    $stmt->bind_param("sisdssi", $name, $exp, $specialty, $price, $desc, $image, $id);
    return $stmt->execute();
}

function deleteCoach($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM coaches WHERE id = ?");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


/* ============================================================
   COACH BOOKING
   ============================================================ */

function createCoachBooking($user_id, $coach_id, $date, $start, $end, $total) {
    global $conn;
    $stmt = $conn->prepare(
        "INSERT INTO coach_booking (user_id, coach_id, booking_date, start_time, end_time, total_price)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("iisssd", $user_id, $coach_id, $date, $start, $end, $total);
    return $stmt->execute();
}

function getCoachBookingsByUser($user_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT cb.*, c.coach_name
         FROM coach_booking cb
         JOIN coaches c ON cb.coach_id = c.id
         WHERE cb.user_id = ?
         ORDER BY cb.created_at DESC"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function getAllCoachBookings() {
    global $conn;
    $sql =
    "SELECT cb.*, u.name as user_name, c.coach_name
     FROM coach_booking cb
     JOIN users u ON cb.user_id = u.id
     JOIN coaches c ON cb.coach_id = c.id
     ORDER BY cb.created_at DESC";

    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllCoachBookings: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateCoachBookingStatus($id, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE coach_booking SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    return $stmt->execute();
}


/* ============================================================
   PAYMENTS
   ============================================================ */

function createPayment($user_id, $type, $booking_id, $amount, $method) {
    global $conn;
    $stmt = $conn->prepare(
        "INSERT INTO payments (user_id, type, booking_id, amount, payment_method)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("isids", $user_id, $type, $booking_id, $amount, $method);
    return $stmt->execute();
}

function getPaymentsByUser($user_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT * FROM payments WHERE user_id = ? ORDER BY created_at DESC"
    );
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function updatePaymentStatus($id, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE payments SET payment_status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    return $stmt->execute();
}


/* ============================================================
   REVIEWS
   ============================================================ */

function createReview($user_id, $type, $item_id, $rating, $comment) {
    global $conn;
    $stmt = $conn->prepare(
        "INSERT INTO reviews (user_id, type, item_id, rating, comment)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("isiis", $user_id, $type, $item_id, $rating, $comment);
    return $stmt->execute();
}

function getReviewsByItem($type, $item_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT r.*, u.name
         FROM reviews r
         JOIN users u ON r.user_id = u.id
         WHERE r.type = ? AND r.item_id = ?
         ORDER BY r.created_at DESC"
    );
    $stmt->bind_param("si", $type, $item_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function getAverageRating($type, $item_id) {
    global $conn;
    $stmt = $conn->prepare(
        "SELECT AVG(rating) AS avg_rating
         FROM reviews
         WHERE type = ? AND item_id = ?"
    );
    $stmt->bind_param("si", $type, $item_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    return $row['avg_rating'] ? round($row['avg_rating'], 1) : 0.0;
}

function getAllReviews() {
    global $conn;

    $sql = "
    SELECT r.*,
           u.name AS user_name,
           CASE
                WHEN r.type = 'court' THEN c.court_name
                WHEN r.type = 'coach' THEN co.coach_name
           END AS item_name
    FROM reviews r
    JOIN users u ON r.user_id = u.id
    LEFT JOIN courts c ON r.type = 'court' AND r.item_id = c.id
    LEFT JOIN coaches co ON r.type = 'coach' AND r.item_id = co.id
    ORDER BY r.created_at DESC";

    $result = $conn->query($sql);

    if (!$result) {
        die("SQL ERROR getAllReviews: " . $conn->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}


/* ============================================================
   STATISTICS
   ============================================================ */

function getTotalUsers() {
    global $conn;
    return $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
}

function getTotalCourts() {
    global $conn;
    return $conn->query("SELECT COUNT(*) AS total FROM courts")->fetch_assoc()['total'];
}

function getTotalCoaches() {
    global $conn;
    return $conn->query("SELECT COUNT(*) AS total FROM coaches")->fetch_assoc()['total'];
}

?>
