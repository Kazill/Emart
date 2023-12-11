<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate the input
    $userId = isset($_POST['id_Naudotojas']) ? intval($_POST['id_Naudotojas']) : null;
    $vardas = mysqli_real_escape_string($conn, trim($_POST['Vardas']));
    $pavarde = mysqli_real_escape_string($conn, trim($_POST['Pavarde']));
    $arBlokuotas = mysqli_real_escape_string($conn, trim($_POST['ArBlokuotas']));
    $password = $_POST['Password']; // You may want to hash the password here if it's changed

    // Prepare an SQL statement to update the user's information
    $sql = "UPDATE naudotojai SET Vardas=?, Pavarde=?, Ar_blokuotas=? WHERE id_Naudotojas=?";
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE naudotojai SET Vardas=?, Pavarde=?, Slaptazodis=?, Ar_blokuotas=? WHERE id_Naudotojas=?";
    }

    $stmt = $conn->prepare($sql);

    // Bind the parameters and execute the statement
    if (empty($password)) {
        $stmt->bind_param("sssi", $vardas, $pavarde, $arBlokuotas, $userId);
    } else {
        $stmt->bind_param("ssssi", $vardas, $pavarde, $hashedPassword, $arBlokuotas, $userId);
    }
    
    if ($stmt->execute()) {
        // If successful, redirect to the user list with a success message
        $_SESSION['message'] = "Naudotojo informacija sėkmingai atnaujinta.";
        header("Location: /Emart/parduotuve/naudotojas/naudotojai.php");
        exit;
    } else {
        // If there is an error, redirect back with an error message
        $_SESSION['message'] = "Klaida atnaujinant naudotojo informaciją: " . $stmt->error;
        header("Location: /Emart/parduotuve/naudotojas/naudotojai.php");
        exit;
    }
} else {
    // If the form hasn't been submitted, redirect back to the user list
    header("Location: /Emart/parduotuve/naudotojas/naudotojai.php");
    exit;
}
?>
