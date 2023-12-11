<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start the session only if one hasn't already been started
if (session_id() == '') {
    session_start();
}

require_once("include/functions.php"); // Assuming functions.php contains necessary functions

// Check if the user is already logged in
if (!empty($_SESSION['user_email'])) {
    // Redirect to the main page of the user
    header("Location: prekiu_posisteme/perziureti_prekiu_sarasa.php");
    exit;
}

// Initialize or clear session variables
if (!isset($_SESSION['prev'])) {
    inisession("full"); // Set session variables to default values
} elseif ($_SESSION['prev'] != "proclogin") {
    inisession("part"); // Clear only part of the session
}

?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Elektronikos el. parduotuvė</title>
    <link href="include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table class="center">
        <tr>
            <td>
                <center><img src="include/top.png"></center>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
                {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                    // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
                    inisession("part");   //   pavalom prisijungimo etapo kintamuosius
                    $_SESSION['prev'] = "index";
                    header("Location:prekiu_posisteme/perziureti_prekiu_sarasa.php");
                    exit;
                    //include("include/meniu.php"); //įterpiamas meniu pagal vartotojo rolę
                } else {

                    if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
                    else {
                        if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                    }
                    // jei ankstesnis puslapis perdavė $_SESSION['message']
                    echo "<div align=\"center\">";
                    echo "<font size=\"4\" color=\"#ff0000\">" . $_SESSION['message'] . "<br></font>";
                    $_SESSION['message'] = '';
                    echo "<table class=\"center\"><tr><td>";
                    include("include/login.php");                    // prisijungimo forma
                    echo "</td></tr></table></div><br>";
                }
                ?>
</body>

</html>