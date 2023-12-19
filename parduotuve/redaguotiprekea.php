<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

$host = 'localhost';    // Hostname of your database server
$user = 'root';    // Username for database access
$pass = '';    // Password for database access
$db   = 'isp';    // Name of your database
$lentele="prekes";

$conn = new mysqli($host, $user, $pass, $db);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
	$pavadinimas = $_POST['Pavadinimas'];
	$kaina = $_POST['Kaina'];
	$id = $_POST['id_Preke'];
	$kategorija = $_POST['kategorija'];
	//$kiekis = $_POST['kiekis'];
	//$garantija = $_POST['garantija'];
	//$pristatymasgeriausiuatveju = $_POST['pristatymasgeriausiuatveju'];
	//$pristatymasblogiausiuatveju = $_POST['pristatymasblogiausiuatveju'];
	$gamintojas = $_POST['Gamintojas'];

	/*
	$sql = "  UPDATE `$lentele`
					SET    `id`='{$id}',
					`pavadinimas`='{$pavadinimas}',
					`kaina`='{$kaina}',
					`kategorija`='{$kategorija}',
					`kiekis`='{$kiekis}',
					`garantija`='{$garantija}',
					`pristatymasgeriausiuatveju`='{$pristatymasgeriausiuatveju}',
					`pristatymasblogiausiuatveju`='{$pristatymasblogiausiuatveju}',
					`gamintojas`='{$gamintojas}'
					WHERE `id`='{$id}'";
	*/
	
	$sql = "  UPDATE `$lentele`
					SET
					`pavadinimas`='{$pavadinimas}',
					`kaina`='{$kaina}',
					`gamintojas`='{$gamintojas}',
					`kategorija` = '{$kategorija}'
					WHERE `id_Preke`='{$id}'";

    if (!$result = $conn->query($sql)) die("Negaliu atnaujinti: " . $conn->error);
	else {header("Location: /Emart/parduotuve/prekiu_posisteme/preke.php?id=$id");} 
}


?>