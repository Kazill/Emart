<?php
include("include/nustatymai.php");

$server=DB_SERVER;
$user=DB_USER;
$password=DB_PASS;
$dbname=DB_NAME;
$lentele="uzsakymas";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

$id = $_GET['id'];
echo $id;
$sql = "UPDATE $lentele SET `is_cancelled` = 1 WHERE `id`='{$id}'";
if (!$result = $conn->query($sql)) die("Negaliu atšaukti: " . $conn->error);
{header("Location:paslauguposisteme.php");exit;} 


?>