<?php
// index.php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your DB connection file
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Prekių posistemė</title>
        <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
    </head>
	<script>
		function showConfirmDialog(removeId) {
			var r = confirm("Ar tikrai norite pašalinti!");
			if (r === true) {
				window.location.replace("salintipreke.php?id=" + removeId);
			}
		}
	</script>
    <body>
        <table class="center" ><tr><td>
            <center><h1>Naudotojai</h1></center>
        </td></tr><tr><td> 
<?php
    if (!empty($_SESSION['email'])) {
        echo "<center style='color: red'>".$_SESSION['message']."</center>";
        $_SESSION['message']='';
		include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/meniu.php");
		inisession("part");
		$_SESSION['prev']="index"; 
		// Your user list logic starts here
        $sql = "SELECT * FROM naudotojai"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div style='background-color: aqua; padding: 10px;'>";
                echo "<p>Vardas: " . htmlspecialchars($row['Vardas']) . "</p>"; // Replace 'first_name' with your column name
                echo "<p>Pavardė: " . htmlspecialchars($row['Pavarde']) . "</p>"; // Replace 'last_name' with your column name
                echo "<button onclick=\"window.location.href='/Emart/parduotuve/naudotojas/profilis.php?id=" . htmlspecialchars($row['id_Naudotojas']) . "'\">Peržiūrėti</button>";

                echo "</div><br>";
            }
        } else {
            echo "No users found";
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
