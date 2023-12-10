<?php
session_start();

// Įtraukiamas failas su duomenų bazės prisijungimo informacija ir funkcijomis
include("include/functions.php");

// Patikrinama, ar vartotojas prisijungęs
if (!empty($_SESSION['email'])) {
    // Duomenų bazės prisijungimo informacija
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'isp';

    // Sukuriamas prisijungimas prie duomenų bazės
    $conn = new mysqli($server, $user, $password, $dbname);

    // Tikrinama ar prisijungimas pavyko
    if ($conn->connect_error) {
        die("Nepavyko prisijungti: " . $conn->connect_error);
    }

    // Čia reikės gauti vartotojo ID iš sesijos arba duomenų bazės
    // Pavyzdžiui, $vartotojoId = $_SESSION['vartotojo_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prekes_id'])) {
        $prekesId = $_POST['prekes_id'];

        // Ištrinama prekė iš krepšelio
        $sql = "DELETE FROM krepselis WHERE naudotojo_id = ? AND prekes_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $vartotojoId, $prekesId);
        $stmt->execute();

        if ($stmt->error) {
            echo "Klaida: " . $stmt->error;
        } else {
            echo "Prekė sėkmingai pašalinta iš krepšelio.";
        }
    }

    $conn->close();
} else {
    echo "Vartotojas neprisijungęs.";
}
?>
