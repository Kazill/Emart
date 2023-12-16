<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $idp=$_GET['pid'];
 try{
    $sql = "DELETE FROM komentarai WHERE `id_Komentaras`='{$id}'";
    if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
 }
    catch(Exception $e){
        $_SESSION['message'] =  "Panaikinti komentaro nepavyko";
    }
    header("Location:/Emart/parduotuve/prekiu_posisteme/preke.php?id=$idp");exit; 

} else {
    echo "No ID provided";
    exit; // Stop further rendering if no ID is provided
}
?>