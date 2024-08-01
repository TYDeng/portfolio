<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.html"); // Redirect non-admins to login page
    exit;
}

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script> <!-- Assuming you have the fetchPatients function here -->
</head>
<body>
<div class="container">
    <h1>Admin Dashboard</h1>
    <form action="register_patient.php" method="POST">
        <input type="text" name="name" placeholder="Patient Name" required>
        <input type="text" name="code" placeholder="Patient Code (ex:12345)" required>
        <input type="number" name="severity" placeholder="Severity (1-10)" required>
        <input type="number" name="wait_time" placeholder="Initial Wait Time (minutes)" required>
        <button type="submit">Register</button>
    </form>
    <button onclick="location.href='signout.php'">Sign Out</button>
    <h2>Current Patient Queue</h2>
    <input type="hidden" id="userRole" value="admin"> <!-- Pass role to JS -->
    <div id="patientList"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchPatients(); // Fetch patients on page load
        });
    </script>
</div>
</body>
</html>

