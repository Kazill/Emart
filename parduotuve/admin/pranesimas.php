<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\composer\vendor\autoload.php';
ini_set("display_errors", "1");
error_reporting(E_ALL);
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");
$_SESSION['prev'] = "zinutes";
?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Pranešimas</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    $siuntejas = $_SESSION['userId'];
    $gavejas = $_GET['email'];

    if ($_POST != null) {
        $header = $_POST['priezastis'];
        $text = $_POST['tekstas'];
        $sql = "INSERT INTO pranesimai (gavejas, fk_Administratoriusid_Administratorius, data, tekstas, priezastis) VALUES ('$gavejas', '$siuntejas', now(), '$text', '$header')";
        if (!mysqli_query($conn, $sql))  $_SESSION['message'] = "Klaida įrašant:" . mysqli_error($dbc);

        $mail = new PHPMailer(true);
        try {

            // Server settings
            $mail->SMTPDebug = 2;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'parduotuve.email@gmail.com';                     // SMTP username
            $mail->Password   = 'bwht lrdu avur xilh';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // Recipients
            $mail->setFrom('parduotuve.email@gmail.com', 'Elektroniniu prekiu parduotuve');    // Add a recipient
            $mail->addAddress($gavejas);               // Name is optional
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $header;
            $mail->Body    = $text;
            $mail->send();
            $_SESSION['message'] = "Pranešimas išsiųstas";
        } catch (Exception $e) {
            //Something went bad
            $_SESSION['message'] = "Klaida siunčiant:" . $mail->ErrorInfo;
        }

        header('Location: /Emart/parduotuve/naudotojas/naudotojai.php');
        exit();
    }
    ?>
    <table class="center">
        <tr>
            <td><img src="/Emart/parduotuve/include/top.png"></td>
        </tr>
        <tr>
            <td>
                <table style="border-width: 2px; border-style: dotted;">
                    <tr>
                        <td>
                            Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]</td>
                    </tr>
                </table> <br>
                <?php
                echo "<center style='color: red'>" . $_SESSION['message'] . "</center>";
                $_SESSION['message'] = '';
                ?>
                <div style="background-color: aqua; padding: 10px;">
                    <center><b>Pranešimas</b></center>
                    <div align="center" style="background-color: aqua; padding: 10px;">
                        <form method="post">
                            <p style="text-align:left;">Priežastis:<br>
                                <input type="text" name="priezastis">
                            </p>
                            <p style="text-align:left;">Tekstas:<br>
                                <textarea name="tekstas" rows="4" cols="50"></textarea>
                            </p>

                            <center><input type='submit' name='ok' value='Siųsti' class="btnbtn-default"></center>
                            </p>
                        </form>
                    </div>
    </table>
    </div>
    </td>
    </tr>
    </table>
</body>

</html>