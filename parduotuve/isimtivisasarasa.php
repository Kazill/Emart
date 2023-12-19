<?php
session_start();

// Įtraukiamas failas su duomenų bazės prisijungimo informacija ir funkcijomis
include("include/functions.php");

// Patikrinama, ar vartotojas prisijungęs
if (!empty($_SESSION['email'])) {
    // Duomenų bazės prisijungimo informacija
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'isp';

    // Sukuriamas prisijungimas prie duomenų bazės
    $conn = new mysqli($server, $user, $password, $dbname);

   
   header("Location: krepselis.php"); 
}
?>
