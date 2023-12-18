<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\composer\vendor\autoload.php';
function getAdministratorEmails($conn)
{
    $emails = [];
    $query = "SELECT El_pastas FROM naudotojai WHERE Naudotojo_lygis = ?"; // Adjust the condition according to your logic
    if ($stmt = $conn->prepare($query)) {
        $adminLevel = 1; // Change this to the level that represents administrators
        $stmt->bind_param("i", $adminLevel);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $emails[] = $row['El_pastas'];
        }
        $stmt->close();
    }
    return $emails;
}

session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    die("Reikia būti prisijungus norint vertinti prekes");
}

// Assign the session email to a variable
$email = $_SESSION['email'];

$naudotojasId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $priezastis = mysqli_real_escape_string($conn, $_POST['Priežastis']);
    $tekstas = mysqli_real_escape_string($conn, $_POST['Tekstas']);

    // Find the corresponding id_Pardavejas for the given id_Naudotojas
    $stmt = $conn->prepare("SELECT id_Pardavejas FROM pardavejai WHERE fk_Naudotojasid_Naudotojas = ?");
    $stmt->bind_param("i", $naudotojasId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $pardavejasId = $row['id_Pardavejas'];

        // Insert the appeal
        $insertSql = "INSERT INTO apeliacijos (tekstas, priezastis, data, fk_Pardavejasid_Pardavejas) VALUES (?, ?, CURDATE(), ?)";
        if ($insertStmt = $conn->prepare($insertSql)) {
            $insertStmt->bind_param("ssi", $tekstas, $priezastis, $pardavejasId);
            if ($insertStmt->execute()) {
                echo "<p>Apeliacija išsiųsta sėkmingai!</p>";

                // Fetch administrator emails and select one at random
                $adminEmails = getAdministratorEmails($conn);
                if (!empty($adminEmails)) {
                    $randomAdminEmail = $adminEmails[array_rand($adminEmails)];
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
                        $mail->addAddress($randomAdminEmail);               // Name is optional
                        // Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = $priezastis;
                        $mail->Body    = $tekstas;
                        $mail->send();
                        $_SESSION['message'] = "Pranešimas išsiųstas";
                    } catch (Exception $e) {
                        //Something went bad
                        $_SESSION['message'] = "Klaida siunčiant:" . $mail->ErrorInfo;
                    }
            
                }
            } else {
                echo "<p>Klaida siunčiant apeliaciją: " . $stmt->error . "</p>";
            }
            $insertStmt->close();
        }
    } else {
        echo "<p>Vartotojas nėra pardavėjas.</p>";
    }
    $stmt->close();
}
?>

<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Apeliacija</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
    <table class="center">
        <tr>
            <td><img src="/Emart/parduotuve/include/top.png"></td>
        </tr>
        <tr>
            <td>
                <table style="border-width: 2px; border-style: dotted;">
                    <tr>
                        <td>
                            Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]
                        </td>
                    </tr>
                </table> <br>
                <div style="background-color: aqua; padding: 10px;">
                    <center><b>Apeliacija</b></center>
                    <div align="center" style="background-color: aqua; padding: 10px;">
                        <form action="apeliacija.php?id=<?php echo $naudotojasId; ?>" method="post">
                            <p style="text-align:left;">Priežastis:<br>
                                <input type="text" name="Priežastis" value="Pardavinėja broką" />
                            </p>
                            <p style="text-align:left;">Tekstas:<br>
                                <textarea name="Tekstas" rows="4" cols="50">Nusipirkau rašiklį ir kai jį gavau jis buvo be rašalo.</textarea>
                            </p>

                            <button type="submit">Siųsti apeliaciją</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>