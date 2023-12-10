<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Sanitize the input

    // Prepare a SQL query to fetch the user's data
    $query = $conn->prepare("SELECT Vardas, Pavarde, El_pastas, Slaptazodis, Ar_blokuotas, Naudotojo_lygis FROM naudotojai WHERE id_Naudotojas = ?");
    $query->bind_param("i", $userId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        echo "No user found with ID: " . $userId;
        exit; // Stop further rendering if no user is found
    }

    $query->close();
} else {
    echo "No user ID provided";
    exit; // Stop further rendering if no ID is provided
}
$userLevel=htmlspecialchars($userData['Naudotojo_lygis']);
$userEmail=htmlspecialchars($userData['El_pastas']);
?>
<html>
    <head>  
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
        <title>Naudotojas</title>
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
                Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]
            </td></tr></table><br>
            <div style="background-color: aqua; padding: 10px;">
                <center><b>Naudotojas</b></center>
                <p style="text-align:left;">Vardas: <?php echo htmlspecialchars($userData['Vardas']); ?></p>
                <p style="text-align:left;">Pavardė: <?php echo htmlspecialchars($userData['Pavarde']); ?></p>
                <p style="text-align:left;">El. paštas: <?php echo htmlspecialchars($userData['El_pastas']); ?></p>
                <p style="text-align:left;">Slaptažodis: <?php echo htmlspecialchars($userData['Slaptazodis']); ?></p>
                <p style="text-align:left;">Ar blokuotas: <?php echo htmlspecialchars($userData['Ar_blokuotas']); ?></p>
                <button onclick="window.location.href='/Emart/parduotuve/naudotojas/redaguoti.php?id=<?php echo $userId; ?>'">Redaguoti</button>
                <button onclick="window.location.href='/Emart/parduotuve/admin/pranesimas.php?email=<?php echo $userEmail; ?>'">Pranešimas</button>
                <button onclick="window.location.href='/Emart/parduotuve/naudotojas/apeliacija.php?id=<?php echo $userId; ?>'">Apeliacija</button>
                <?php 
                if($userData['Ar_blokuotas'] == 0){
                    echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/blokuoti.php?block=1&id=$userId', 'Blokuoti');\">Blokuoti</button>";
                }
                else{
                    echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/blokuoti.php?block=0&id=$userId', 'Atblokuoti');\">Atblokuoti</button>";
                }
                ?>
                <button onclick="confirmAction('/Emart/parduotuve/admin/salinti.php?id=<?php echo $userId; ?>&level=<?php echo $userLevel; ?>', 'Pašalinti');">Pašalinti</button>
            </div>
        </td></tr></table>           
    </body>
</html>
