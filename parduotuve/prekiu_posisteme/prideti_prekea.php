<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

$host = 'localhost';    // Hostname of your database server
$user = 'root';    // Username for database access
$pass = '';    // Password for database access
$db   = 'isp';    // Name of your database
$lentele='prekes';

$conn = new mysqli($host, $user, $pass, $db);
   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

if($_POST != null){
	$pavadinimas = $_POST['Pavadinimas'];
	$kaina = $_POST['Kaina'];
	$pardavejas = $_POST['seller_email'];
	//$kategorija = $_POST['kategorija'];
	//$kiekis = $_POST['kiekis'];
	//$garantija = $_POST['garantija'];
	//$pristatymasgeriausiuatveju = $_POST['pristatymasgeriausiuatveju'];
	//$pristatymasblogiausiuatveju = $_POST['pristatymasblogiausiuatveju'];
	$gamintojas = $_POST['Gamintojas'];

	$sql_seller_id = "SELECT id_Naudotojas, id_Pardavejas FROM naudotojai INNER JOIN pardavejai ON naudotojai.id_Naudotojas=pardavejai.fk_Naudotojasid_Naudotojas WHERE naudotojai.El_pastas='$pardavejas' AND pardavejai.Ar_patvirtintas=1";
	$result_id = mysqli_query($conn, $sql_seller_id);
	if (mysqli_num_rows($result_id) > 0){
		$row = mysqli_fetch_assoc($result_id);
		$seller_id = $row['id_Pardavejas'];
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
	
	$stmt = $conn->prepare("INSERT INTO prekes (`pavadinimas`, `kaina`, `kategorija`, `gamintojas`, `ar_paslepta`, `id_Preke`, `fk_Pardavėjasid_Pardavėjas`) VALUES (?, ?, 'default', ?, '0', NULL, ?)");

// Bind parameters
$stmt->bind_param("sdsd", $pavadinimas, $kaina, $gamintojas, $seller_id);

// Execute the query
if ($stmt->execute()) {
    header("Location: /Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
	}
	else {header("Location: /Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php");
	$_SESSION['message'] = "Nesate patvirtintas pardavėjas. Parduoti galėsite, kai jus patvirtins administratorius.";} 
	}
	else {header("Location: /Emart/parduotuve/prekiu_posisteme/index.php");} 
	



?>