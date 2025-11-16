<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    // Check if user already exists
    if (getUserByEmail($email)) {
        $error = "Email already exists";
    } else {
        if (createUser($name, $email, $phone, $password)) {
            $success = "Account created successfully. Please login.";
        } else {
            $error = "Failed to create account";
        }
    }
}
?>

<?php if (isset($error)): ?>
    <script>alert('<?php echo $error; ?>');</script>
<?php endif; ?>

<?php if (isset($success)): ?>
    <script>alert('<?php echo $success; ?>'); window.location.href = 'Account/index.php';</script>
<?php endif; ?>
