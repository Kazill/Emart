<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'] . "/Emart/vendor/autoload.php";
ini_set("display_errors", "1");
error_reporting(E_ALL);

include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE uzsakymai SET `busena` = 'Vykdoma' WHERE `id_Uzsakymas`='{$id}'";
    if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error. $sql);
    sendStatusUpdate("greta.int@gmail.com");
    header("Location:/Emart/parduotuve/admin/uzsakymas.php?id=$id");exit; 

} else {
    echo "No ID provided";
    exit; // Stop further rendering if no ID is provided
}

function sendStatusUpdate($toEmail)
{
    // Send email using PHPMailer
    $mail = new PHPMailer;

    try {

        // Server settings
        $mail->SMTPDebug = 2;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'parduotuve.email@gmail.com';                     // SMTP username
        $mail->Password   = 'bwht lrdu avur xilh';                               // SMTP password
        $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;  
        $mail->CharSet    = 'UTF-8';                                  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        // Recipients
        $mail->setFrom('parduotuve.email@gmail.com', 'Elektroniniu prekiu parduotuve');    // Add a recipient
        $mail->addAddress($toEmail);               // Name is optional
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Jūsų užsakymo būsena pakeista';
        $mail->Body    = '<p>Informuojame, kad sistemoje pasikeitė Jūsų užsakymo būsena.</p> <p>Užsakymą galite peržiūrėti prisijungę su savo paskyra prie El. prekių parduotuvės</p> <p><em>Malonaus apsipirkimo!</em></p></br></br>';
        $mail->send();
        $_SESSION['message']="Pranešimas išsiųstas";
} catch(Exception $e){
//Something went bad
$_SESSION['message']="Klaida siunčiant:" . $mail->ErrorInfo;
}

}
?>