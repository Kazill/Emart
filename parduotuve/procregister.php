<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "register")) {
    header("Location: logout.php");
    exit;
}

include("include/nustatymai.php");
include("include/functions.php");
include("include/db_connect.php");

$_SESSION['prev'] = "procregister";

// Retrieve and sanitize form inputs
$vardas = mysqli_real_escape_string($conn, strtolower(trim($_POST['vardas'])));
$pavarde = mysqli_real_escape_string($conn, strtolower(trim($_POST['pavarde'])));
$el_pastas = mysqli_real_escape_string($conn, trim($_POST['email']));
$slaptazodis = password_hash($_POST['pass'], PASSWORD_DEFAULT); // Hash the password
$ar_blokuotas = 0; // Assuming the user is not blocked by default
$naudotojo_lygis = 0; // Assuming '0' is the default user level

// Validation of form fields
if (checkname($vardas) && checkPasswordStrength($_POST['pass']) && checkmail($el_pastas)) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO naudotojai (Vardas, Pavarde, El_pastas, Slaptazodis, Ar_blokuotas, Naudotojo_lygis) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters to the SQL statement
    $stmt->bind_param("ssssii", $vardas, $pavarde, $el_pastas, $slaptazodis, $ar_blokuotas, $naudotojo_lygis);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registracija sėkminga";
        $stmt->close();
        header("Location: index.php"); // Redirect to the index or another appropriate page
        exit;
    } else {
        $_SESSION['message'] = "Registracijos klaida: " . $stmt->error;
        $stmt->close();
    }
} else {
    // If validation fails, redirect back to the registration form
    header("Location: register.php");
    exit;
}
?>
