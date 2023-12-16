<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $Id = intval($_GET['id']); // Sanitize the input

    // Prepare a SQL query to fetch the user's data
    $query = $conn->prepare("SELECT * FROM prekes INNER JOIN pardavejai ON fk_Pardavėjasid_Pardavėjas=id_Pardavejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas WHERE id_Preke = ?");
    $query->bind_param("i", $Id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $orderData = $result->fetch_assoc();
    } else {
        echo "No order found with ID: " . $Id;
        exit; // Stop further rendering if no user is found
    }

} else {
    echo "No ID provided";
    exit; // Stop further rendering if no ID is provided
}
?>
<html>
    <head>  
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
        <title>Prekė</title>
        <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <script>
		function confirmAction(remove, op) {
			var r = confirm("Ar tikrai norite " + op + "!");
			if (r === true) {
				window.location.replace(remove);
			}
		}
	</script>
    <body>   
        <table class="center"><tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr><tr><td> 
            <table style="border-width: 2px; border-style: dotted;"><tr><td>
                Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php">prekių sąrašą</a>]
            </td></tr></table><br>
            <div style="background-color: aqua; padding: 10px;">
                <center><b>Prekė</b></center>
                <p style="text-align:left;">Pavadinimas: <?php echo htmlspecialchars($orderData['pavadinimas']); ?></p>
                <p style="text-align:left;">Kaina: <?php echo htmlspecialchars($orderData['kaina']); ?></p>
                <p style="text-align:left;">Kategorija: <?php echo htmlspecialchars($orderData['kategorija']); ?></p>
                <p style="text-align:left;">Gamintojas: <?php echo htmlspecialchars($orderData['gamintojas']); ?></p>
                <p style="text-align:left;">Pardavėjas: <?php echo htmlspecialchars($orderData['Vardas']) . " " . htmlspecialchars($orderData['Pavarde']); ?></p>
                <button onclick="window.location.href='/Emart/parduotuve/krepselis.php'">Įdėti į krepšelį</button>
                <button onclick="window.location.href='/Emart/parduotuve/pridetipreke.php'">Redaguoti</button>
                <button onclick=showConfirmDialog(null)>Pašalinti prekę</button>
                <?php
                    if($_SESSION['tipas']=='1')
                    {
                        if($orderData['ar_paslepta'] == 0){
                            echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/paslepti_preke.php?hide=1&id=$Id', 'Paslėpti');\">Paslėpti</button>\n";
                        }
                        else{
                            echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/paslepti_preke.php?hide=0&id=$Id', 'Rodyti');\">Rodyti</button>\n";
                        }
                    }
                ?>
            </div>
        </td></tr><tr><td>
        
        <center><b>Komentarai</b></center>
        <?php
        $sql = "SELECT * FROM prekes INNER JOIN komentarai ON fk_Prekeid_Preke = id_Preke LEFT JOIN pirkejai ON fk_Pirkejasid_Pirkejas=id_Pirkejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas WHERE id_Preke='{$Id}'"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div style='background-color: blue; border: solid; padding-bottom:10px; padding-left:10px; padding-right:10px'>";
                echo "<p>". htmlspecialchars($row['Vardas']). " " . htmlspecialchars($row['Pavarde']) ." ". htmlspecialchars($row['data']). " " . htmlspecialchars($row['laikas']) . ":</p>";
                echo "<p style='background-color: aqua; padding: 10px; border: dashed'><i>" . htmlspecialchars($row['tekstas']) . "</i></p>";
                
                if($_SESSION['tipas']=='1')
                    {
                        $kid=htmlspecialchars($row['id_Komentaras']);
                        echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/trinti_komentara.php?pid=$Id&id=$kid', 'Trinti');\">Trinti</button>\n";
                    }
                echo "</div><br>";
            }
        } else {
            echo "No comments found";
        }
        ?>
        </td></tr></table>  
    </body>
</html>
