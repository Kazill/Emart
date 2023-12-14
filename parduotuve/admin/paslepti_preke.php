<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hide = $_GET['hide'];
    $sql = "UPDATE prekes SET `ar_paslepta` = '{$hide}' WHERE `id_Preke`='{$id}'";
    if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error. $sql);
    header("Location:/Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php");exit; 

} else {
    echo "No ID provided";
    exit; // Stop further rendering if no ID is provided
}
?>