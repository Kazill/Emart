<?php
include("include/nustatymai.php");

$server=DB_SERVER;
$user=DB_USER;
$password=DB_PASS;
$dbname=DB_NAME;
$lentele="Preke";

$conn = new mysqli($server, $user, $password, $dbname);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST !=null){
	$id = $_POST['id'];
	$pavadinimas = $_POST['pavadinimas'];
	$kaina = $_POST['kaina'];
	$kategorija = $_POST['kategorija'];
	$kiekis = $_POST['kiekis'];
	$garantija = $_POST['garantija'];
	$pristatymasgeriausiuatveju = $_POST['pristatymasgeriausiuatveju'];
	$pristatymasblogiausiuatveju = $_POST['pristatymasblogiausiuatveju'];
	$gamintojas = $_POST['gamintojas'];

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

    if (!$result = $conn->query($sql)) die("Negaliu atnaujinti: " . $conn->error);
	{header("Location:prekiuposisteme.php");exit;} 
}


?>