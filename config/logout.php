<?php
session_start();
session_unset();
session_destroy();
echo "You have been logged out successfully!";
header("refresh:2;url=../index.php"); // Redirect after 2 seconds
exit();
?>
