<?php
// log user out and redirect to main page
session_start();
unset($_SESSION['email']);
header("Location: index.php");
?>