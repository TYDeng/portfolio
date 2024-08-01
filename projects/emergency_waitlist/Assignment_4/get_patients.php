<?php
include 'db_connect.php';

$query = $pdo->query("SELECT * FROM patients ORDER BY severity DESC, queue_time ASC");
$patients = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($patients);
?>
