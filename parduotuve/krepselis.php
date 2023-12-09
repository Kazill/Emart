<?php
session_start();
include("include/functions.php");
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
?>
<html>
<head>
	<title>Krepselis</title>
	<meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
	<link href="include/styles.css" rel="stylesheet" type="text/css" >
</head>
<body>

<?php
// Jei vartotojas prisijungęs
if (!empty($_SESSION['email'])) {
    include("include/meniu.php");
    inisession("part");
    $_SESSION['prev'] = "index";

    // Čia reikės gauti vartotojo ID iš sesijos arba duomenų bazės
    // Pavyzdžiui, $vartotojoId = $_SESSION['vartotojo_id'];

    // SQL užklausa prekių gavimui iš krepselis lentelės
    $sql = "SELECT p.id_Preke, p.pavadinimas, p.kaina, k.kiekis FROM Prekes p 
            JOIN uzsakymo_prekes k ON p.id_Preke = k.fk_Prekeid_Preke ";
    
    $stmt = $conn->query($sql);
  //  $stmt->bind_param("i", $vartotojoId);
    //$stmt->execute();
    //$result = $stmt->get_result();

    if ($stmt) {
        echo "<div style='background-color: aqua; padding: 10px;'>";
        echo "<pre><b>Pavadinimas\tKaina\t\tKiekis\t\tSuma</b></pre>";
        while ($item = $stmt->fetch_assoc()) {
            $suma = $item['kaina'] * $item['kiekis'];
            echo "<pre>" . $item['pavadinimas'] . "\t" . $item['kaina'] . "\t\t" . $item['kiekis'] . "\t\t" . $suma . "\t";
            // Mygtukas prekės pašalinimui iš krepšelio
            echo "<form action='isimtiprekekrepselis.php' method='post'>
                      <input type='hidden' name='prekes_id' value='" . $item['id_Preke'] . "'>
                      <input type='submit' value='Pašalinti iš krepšelio'>
                  </form>";
            echo "</pre>";
        }
        echo "<button onclick=\"window.location.href='pirkti.php'\">Pirkti</button>";
        echo "</div>";

        $stmt->free();
    } else {
        echo "Klaida: " . $conn->error;
    }

    $conn->close();
}
?>

</body>
</html>

