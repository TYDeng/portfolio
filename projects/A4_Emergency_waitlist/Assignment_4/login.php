<?php
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

if ($role == 'admin') {
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND role = ?");
    $query->execute([$username, $password, $role]);
} else if ($role == 'patient') {
    $query = $pdo->prepare("SELECT * FROM patients WHERE name = ? AND code = ?");
    $query->execute([$username, $password]);
}

$user = $query->fetch();

if ($user) {
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $role;
    if ($role == 'admin') {
        header("Location: ../admin_dashboard.php");
    } else {
        header("Location: ../patient_dashboard.php");
    }
} else {
    echo "<script>alert('Invalid credentials or role'); window.location.href = '../index.html';</script>";
}
?>

