<?php
session_start();
include("include/functions.php");
include("include/valdymomeniu.php");
$email = $_SESSION['email'];
$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$sql = "DELETE FROM " . TBL_USERS . " WHERE el_pastas='$email'";

mysqli_query($db, $sql);

header("Location:logout.php");
?>