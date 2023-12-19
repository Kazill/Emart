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
$conn1 = new mysqli($server, $user, $password, $dbname);
$conn2 = new mysqli($server, $user, $password, $dbname);

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
<body style="margin-left:auto;margin-right:auto">
<table class ="center">
    <tr><td>
    <center><h1>Krepšelis</h1></center>
        </td></tr><tr><td> 
<?php
// Jei vartotojas prisijungęs
if (!empty($_SESSION['email'])) {
    include("include/meniu.php");
    inisession("part");
    $_SESSION['prev'] = "index";

    // Čia reikės gauti vartotojo ID iš sesijos arba duomenų bazės
    // Pavyzdžiui, $vartotojoId = $_SESSION['vartotojo_id'];

    // SQL užklausa prekių gavimui iš krepselis lentelės
    $sql = "SELECT u.kiekis, p.kaina, p.pavadinimas FROM uzsakymo_prekes as u Left join prekes as p ON  u.fk_Prekeid_Preke = p.id_Preke";
     
        $sql1 = "INSERT INTO uzsakymo_prekes (kiekis, fk_Uzsakymasid_Uzsakymas, fk_Prekeid_Preke)
                 SELECT 1, u.id_Uzsakymas, p.id_Preke 
                 FROM uzsakymai AS u
                 JOIN prekes AS p ON u.uzsakymo_kaina = p.kaina 
                 WHERE u.busena = 'Progrese'";

        $stmt1 = $conn1->query($sql1);

        // Nustatyti sesijos kintamąjį, kad nurodyti, jog įrašas buvo atliktas
    //    $_SESSION['data_inserted'] = true;
    
    $stmt = $conn->query($sql);
  //  $stmt->bind_param("i", $vartotojoId);
    //$stmt->execute();
    //$result = $stmt->get_result();
    
    
    if ($stmt) {
        echo "<div style='background-color: aqua; padding: 10px;'>";
        echo "<pre><b>Pavadinimas\tKaina\tKiekis\t\tSuma</b></pre>";
        while ($item = $stmt->fetch_assoc()) {
            $suma = $item['kaina'] * $item['kiekis'];
            echo "<pre>" . $item['pavadinimas'] . "\t" . $item['kaina'] . "\t\t" . $item['kiekis'] . "\t\t" . $suma . "\t";
            // Mygtukas prekės pašalinimui iš krepšelio
            $sql2= "SELECT * FROM uzsakymai";
            $stmt2= $conn2->query($sql2);
            $item1= $stmt2->fetch_assoc();
            echo "<form action='isimtiprekekrepselis.php' method='post'>
                      <input type='hidden' name='prekes_id' value='" . $item1['id_Uzsakymas'] . "'>
                      <input type='submit' value='Pašalinti iš krepšelio'>
                  </form>";
            echo "</pre>";
        }
        echo "<button onclick=\"window.location.href='pirkti.php'\">Pirkti</button>";
        echo "</div>";

    } else {
        echo "Klaida: " . $conn->error;
        echo "Klaida: " . $conn1->error;
    }

    $conn->close();
}
?></td></tr></table>
</body>
</html>

