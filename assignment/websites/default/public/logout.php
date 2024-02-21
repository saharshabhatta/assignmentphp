<?php
// Start session
session_start();

// Unset all of the session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the index page after logout
header("Location: index.php");
exit;
?>
