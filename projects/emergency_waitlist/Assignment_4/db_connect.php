<?php
$host = 'localhost'; // or your host
$dbname = 'triage_db';
$username = 'root'; // use your database username
$password = 'PASSWORD'; // use your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
