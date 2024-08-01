<?php
include 'db_connect.php';

$name = $_POST['name'];
$code = $_POST['code'];
$severity = $_POST['severity'];
$wait_time = $_POST['wait_time'];

$query = $pdo->prepare("INSERT INTO patients (name, code, severity, queue_time) VALUES (?, ?, ?, ?)");
$query->execute([$name, $code, $severity, $wait_time]);

header("Location: admin_dashboard.php");
?>
