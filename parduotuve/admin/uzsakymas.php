<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $Id = intval($_GET['id']); // Sanitize the input

    // Prepare a SQL query to fetch the user's data
    $query = $conn->prepare("SELECT * FROM uzsakymai INNER JOIN pirkejai ON fk_Pirkejasid_Pirkejas = id_Pirkejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas WHERE id_Uzsakymas = ?");
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
        <title>Užsąkymas</title>
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
                Atgal į [<a href="/Emart/parduotuve/admin/uzsakymai.php">Užsąkymus</a>]
            </td></tr></table><br>
            <div style="background-color: aqua; padding: 10px;">
                <center><b>Užsąkymas</b></center>
                <p style="text-align:left;">Data: <?php echo htmlspecialchars($orderData['data']); ?></p>
                <p style="text-align:left;">Užsąkymo kaina: <?php echo htmlspecialchars($orderData['uzsakymo_kaina']); ?></p>
                <p style="text-align:left;">Būsena: <?php echo htmlspecialchars($orderData['būsena']); ?></p>
                <p style="text-align:left;">Pristatymo būdas: <?php echo htmlspecialchars($orderData['pristatymo_budas']); ?></p>
                <p style="text-align:left;">Pirkėjas: <?php echo htmlspecialchars($orderData['Vardas']) . " " . htmlspecialchars($orderData['Pavarde']); ?></p>
            </div>
        </td></tr><tr><td>
        <center><b>Prekės</b></center>
        <?php
        $sql = "SELECT * FROM uzsakymai INNER JOIN uzsakymo_prekes ON fk_Uzsakymasid_Uzsakymas = id_Uzsakymas INNER JOIN prekes ON fk_Prekeid_Preke=id_Preke INNER JOIN pardavejai ON fk_Pardavėjasid_Pardavėjas=id_Pardavejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas WHERE id_Uzsakymas='{$Id}'"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div style='background-color: aqua; padding: 10px;'>";
                echo "<p>Pavadinimas: " . htmlspecialchars($row['pavadinimas']) . "</p>";
                echo "<p>Pardavėjas: " . htmlspecialchars($row['Vardas']). " " . htmlspecialchars($row['Pavarde']) . "</p>"; // Replace 'first_name' with your column name
                echo "<p>Kaina: " . htmlspecialchars($row['kaina']) . "</p>";
                echo "<p>Kiekis " . htmlspecialchars($row['kiekis']) . "</p>";
                echo "</div><br>";
            }
        } else {
            echo "No orders found";
        }
        ?>
        </td></tr></table>  
    </body>
</html>
