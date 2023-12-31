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
    $conn1 = new mysqli($server, $user, $password, $dbname);

    // Tikrinama ar prisijungimas pavyko
    if ($conn->connect_error) {
        die("Nepavyko prisijungti: " . $conn->connect_error);
    }

    // Čia reikės gauti vartotojo ID iš sesijos arba duomenų bazės
    // Pavyzdžiui, $vartotojoId = $_SESSION['vartotojo_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['prekes_id'])) {
        $prekesId = $_POST['prekes_id'];
    
        // Ištrinama prekė iš krepšelio naudojant prepared statements
        $sql = "DELETE FROM uzsakymo_Prekes WHERE fk_Uzsakymasid_Uzsakymas = $prekesId";
        $sql1 = "DELETE FROM uzsakymai WHERE id_Uzsakymas = $prekesId";
        $stmt = $conn->prepare($sql);
        $stmt1 = $conn1->prepare($sql1);
        if ($stmt &&$stmt1) {
            $stmt->execute();
            $stmt1->execute();
    
            if ($stmt->affected_rows > 0) {
                echo "Prekė sėkmingai pašalinta iš krepšelio";
            } else {
                echo "Prekės pašalinti nepavyko: prekė gali būti jau ištrinta arba įvyko klaida". $conn->error ." kitas ". $conn1->error;
            }
    
            $stmt->close();
            // Redirect to avoid form re-submission on refresh
           // header("Location: krepselis.php"); 
            exit;
        } else {
            echo "Klaida: " . $conn->error;
        }
    }
    
    $conn->close();
} else {
    echo "Vartotojas neprisijungęs.";
}
?>
