<?php
session_start();
session_destroy();  // Clear the session
header("Location: ../index.html");  // Redirect to the login page
?>
