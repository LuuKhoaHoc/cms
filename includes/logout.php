<?php
session_start();
// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to an front page
header("Location: ../index.php");
?>
