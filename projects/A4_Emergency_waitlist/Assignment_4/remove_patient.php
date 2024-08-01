<?php
include 'db_connect.php';

$id = $_POST['id'];

$query = $pdo->prepare("DELETE FROM patients WHERE id = ?");
$query->execute([$id]);
?>
