<?php
// index.php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your DB connection file
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Užsąkymai</title>
        <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td>
            <center><h1>Užsąkymai</h1></center>
        </td></tr><tr><td> 
<?php
    if (!empty($_SESSION['email'])) {
		include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/meniu.php");
		inisession("part");
		$_SESSION['prev']="uzsakymai"; 
		// Your user list logic starts here
        $sql = "SELECT * FROM uzsakymai INNER JOIN pirkejai ON fk_Pirkejasid_Pirkejas = id_Pirkejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div style='background-color: aqua; padding: 10px;'>";
                echo "<p>Užsąkymo Id: " . htmlspecialchars($row['id_Uzsakymas']) . "</p>";
                echo "<p>Pirkėjas: " . htmlspecialchars($row['Vardas']). " " . htmlspecialchars($row['Pavarde']) . "</p>"; // Replace 'first_name' with your column name
                echo "<p>Užsąkymo data: " . htmlspecialchars($row['data']) . "</p>";
                echo "<p>Užsąkymo kaina: " . htmlspecialchars($row['uzsakymo_kaina']) . "</p>";
                echo "<button onclick=\"window.location.href='/Emart/parduotuve/admin/uzsakymas.php?id=" . htmlspecialchars($row['id_Uzsakymas']) . "'\">Peržiūrėti</button>";

                echo "</div><br>";
            }
        } else {
            echo "No orders found";
        }
		// User list logic ends here
    } else {
        // Code for users who are not logged in
        if (!isset($_SESSION['prev'])) inisession("full");             
        else {if ($_SESSION['prev'] != "proclogin") inisession("part");}  
        echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
        echo "<table class=\"center\"><tr><td>";
        include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/login.php"); // Login form
        echo "</td></tr></table></div><br>";
    }
?>
        </td></tr></table>
    </body>
</html>
