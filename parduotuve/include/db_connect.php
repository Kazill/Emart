<?php
// db_connect.php
//require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
$host = 'localhost';    // Hostname of your database server
$user = 'root';    // Username for database access
$pass = '';    // Password for database access
$db   = 'isp';    // Name of your database

// // Create a new database connection
$conn = new mysqli($host, $user, $pass, $db);


// This is for the nustatymai database connection
 //require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
 //$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally set the charset, if needed
$conn->set_charset("utf8"); // Replace 'utf8' with the charset of your choice

// The connection is now established and you can use $conn to interact with your database
?>
