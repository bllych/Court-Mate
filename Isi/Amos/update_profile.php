<?php
session_start();
require_once '../../db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../Account/index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (updateUser($_SESSION['user_id'], $name, $email, $phone)) {
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $success = "Profile updated successfully";
    } else {
        $error = "Failed to update profile";
    }
}

header('Location: Users-page.php');
exit();
?>
