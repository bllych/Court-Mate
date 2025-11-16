<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $user = getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header('Location: Isi/Amos/Admin-page.php');
        } else {
            header('Location: index.php');
        }
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<?php if (isset($error)): ?>
    <script>alert('<?php echo $error; ?>');</script>
<?php endif; ?>
