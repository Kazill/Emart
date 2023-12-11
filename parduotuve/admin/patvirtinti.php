<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE pardavejai SET `Ar_patvirtintas` = '1', `Patvirtinimo_data`=now() WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
    if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error. $sql);
    header("Location:/Emart/parduotuve/admin/prasymai.php");exit; 

} else {
    echo "No user ID provided";
    exit; // Stop further rendering if no ID is provided
}
?>