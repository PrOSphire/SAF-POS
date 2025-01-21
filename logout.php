<?php
// logout.php - Handles logging out the user

session_start(); // Start session to access session variables

// Destroy the session and redirect to login page
session_unset(); 
session_destroy();
header("Location: login.php");
exit();
?>
