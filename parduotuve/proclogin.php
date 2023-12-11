<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

$_SESSION['prev'] = "proclogin";

require_once("include/nustatymai.php");
require_once("include/functions.php");
require_once("include/db_connect.php");

// Clear any previous error messages
$_SESSION['mail_error'] = '';
$_SESSION['pass_error'] = '';
$_SESSION['message'] = "";

// Retrieve and sanitize form inputs
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$password = $_POST['pass'];

// SQL query to check if the user exists with the given email
$stmt = $conn->prepare("SELECT Vardas, Pavarde, Slaptazodis, Naudotojo_lygis FROM naudotojai WHERE El_pastas = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verify the password
    if (password_verify($password, $row['Slaptazodis'])) {
        // Password is correct, set session variables
        $_SESSION['vardas'] = $row['Vardas'];
        $_SESSION['pavarde'] = $row['Pavarde'];
        $_SESSION['tipas'] = $row['Naudotojo_lygis']; // Assuming 'Naudotojo_lygis' is the column name for user level
        $_SESSION['email']=$email;
        $_SESSION['message'] = "Sėkmingai prisijungėte!";

        // Redirect to a logged-in page
        header("Location: /Emart/parduotuve/index.php");
        exit;
    } else {
        // Password is incorrect, set session error message
        $_SESSION['pass_error'] = "Neteisingas slaptažodis.";
        header("Location: /Emart/parduotuve/index.php");
        exit;
    }
} else {
    // Email not found, set session error message
    $_SESSION['mail_error'] = "Vartotojas su tokiu el. paštu nerastas.";
    header("Location: /Emart/parduotuve/index.php");
    exit;
}

$stmt->close();
$conn->close();
?>
