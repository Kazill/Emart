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

$vardas = mysqli_real_escape_string($conn, strtolower(trim($_POST['vardas'])));
$pavarde = mysqli_real_escape_string($conn, strtolower(trim($_POST['pavarde'])));
$el_pastas = mysqli_real_escape_string($conn, trim($_POST['email']));
$slaptazodis = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$ar_blokuotas = 0;
$naudotojo_lygis = mysqli_real_escape_string($conn, trim($_POST['role']));
$tel = ($naudotojo_lygis == "1") ? mysqli_real_escape_string($conn, $_POST['tel']) : null;
$naudotojo_lygis = ($naudotojo_lygis == "1") ? 0 : $naudotojo_lygis;
if (checkname($vardas) && checkPasswordStrength($_POST['pass']) && checkmail($el_pastas)) {
    $stmt = $conn->prepare("INSERT INTO naudotojai (Vardas, Pavarde, El_pastas, Slaptazodis, Ar_blokuotas, Naudotojo_lygis) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $vardas, $pavarde, $el_pastas, $slaptazodis, $ar_blokuotas, $naudotojo_lygis);

    if ($stmt->execute()) {
        $userId = $stmt->insert_id;
        $stmtRole = null;

        switch ($naudotojo_lygis) {
            case "1": // Administratorius
                $stmtRole = $conn->prepare("INSERT INTO administratoriai (idarbinimo_data, Tel_nr, fk_Naudotojasid_Naudotojas) VALUES (CURDATE(), ?, ?)");
                $stmtRole->bind_param("si", $tel, $userId);
                break;
            case "2": // Darbuotojas (Assuming 'pardavejai' table)
                $stmtRole = $conn->prepare("INSERT INTO pardavejai (Ar_patvirtintas, patvirtinimo_data, Ikeltu_prekiu_skaicius, vertinimu_vidurkis, fk_Naudotojasid_Naudotojas) VALUES (0, NULL, 0, NULL, ?)");
                $stmtRole->bind_param("i", $userId);
                break;
            case "3": // Klientas (Assuming 'pirkejai' table)
                $stmtRole = $conn->prepare("INSERT INTO pirkejai (vertinimu_vidurkis, uzsakymu_skaicius, komentaru_skaicius, fk_Naudotojasid_Naudotojas) VALUES (NULL, 0, 0, ?)");
                $stmtRole->bind_param("i", $userId);
                break;
            // Add more cases for other roles
        }
        

        if ($stmtRole && !$stmtRole->execute()) {
            $_SESSION['message'] = "Role-specific registration error: " . $stmtRole->error;
            $stmtRole->close();
            header("Location: register.php");
        } else {
            $_SESSION['message'] = "Registracija sėkminga";
            header("Location: index.php");
        }
    } else {
        $_SESSION['message'] = "Registracijos klaida: " . $stmt->error;
        header("Location: register.php");
    }
    $stmt->close();
} else {
    $_SESSION['message'] = "Formos validacijos klaida";
    header("Location: register.php");
}
exit;
?>
