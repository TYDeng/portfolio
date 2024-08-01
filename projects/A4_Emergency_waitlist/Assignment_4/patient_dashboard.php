<?php
session_start();
if ($_SESSION['role'] != 'patient') {
    header("Location: index.html"); // Redirect non-patients to login page
    exit;
}

include 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js"></script> <!-- Assuming you have the fetchPatients function here -->
</head>
<body>
<div class="container">
    <h1>Patient Dashboard</h1>
    <h2>Current Patient Queue</h2>
    <input type="hidden" id="userRole" value="patient"> <!-- Pass role to JS -->
    <div id="patientList"></div>
    <button onclick="location.href='signout.php'">Sign Out</button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchPatients(); // Fetch patients on page load
        });
    </script>
</div>
</body>
</html>

