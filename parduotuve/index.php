<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once("include/functions.php"); // Assuming functions.php contains necessary functions

// Check if user is already logged in
if (!empty($_SESSION['email'])) {
    // Redirect to main page of the user
    header("Location: prekiu_posisteme/perziureti_prekiu_sarasa.php");
    exit;
}

// Initialize or clear session variables
if (!isset($_SESSION['prev'])) {
    inisession("full"); // Set session variables to default values
} else {
    if ($_SESSION['prev'] != "proclogin") {
        inisession("part"); // Clear only part of the session
    }
}
?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Elektronikos el. parduotuvė</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <table class="center"><tr><td>
        <center><img src="include/top.png" alt="Top"></center>
    </td></tr></table>
    <?php
    // Display email error message if set
    if (isset($_SESSION['mail_error']) && $_SESSION['mail_error'] != '') {
        echo "<div align=\"center\"><font size=\"4\" color=\"#ff0000\">" . $_SESSION['mail_error'] . "<br></font></div>";
        unset($_SESSION['mail_error']); // Clear the message
    }
    // Display password error message if set
    if (isset($_SESSION['pass_error']) && $_SESSION['pass_error'] != '') {
        echo "<div align=\"center\"><font size=\"4\" color=\"#ff0000\">" . $_SESSION['pass_error'] . "<br></font></div>";
        unset($_SESSION['pass_error']); // Clear the message
    }

    // Include login form
    include("include/login.php");
    ?>
</body>
</html>
