<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Prekių posistemė</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
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
            <center><img src="include/prekiuposistemestop.png"></center>
        </td></tr><tr><td> 
<?php
           
    if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/prekiuposistemesmeniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
			
			<?php

			#Prisijungimas

			$server="localhost";
			$user="stud";
			$password="stud";
			$dbname="isp";
			$lentele="Preke";

			$datanuo = $_POST['datanuo'];
			$dataiki = $_POST['dataiki'];
			
			$sqlFilter;
		
			if (strlen($_POST['datanuo']) == 0)
			{
				if (strlen($_POST['dataiki']) == 0)
					$sqlFilter = "SELECT Uzsakymas.id FROM Uzsakymas WHERE Uzsakymas.busena=4";
				else
					$sqlFilter = "SELECT Uzsakymas.id FROM Uzsakymas WHERE Uzsakymas.uzsakymodata <= \"$dataiki\" AND Uzsakymas.busena=4";
			} else {
				if (strlen($_POST['dataiki']) == 0)
					$sqlFilter = "SELECT Uzsakymas.id FROM Uzsakymas WHERE Uzsakymas.uzsakymodata >= \"$datanuo\" AND Uzsakymas.busena=4";
				else
					$sqlFilter = "SELECT Uzsakymas.id FROM Uzsakymas WHERE Uzsakymas.uzsakymodata <= \"$dataiki\" AND Uzsakymas.uzsakymodata >= \"$datanuo\" AND Uzsakymas.busena=4";
			}
		
			#$sql = "SELECT Sum(UzsakymoPreke.kiekis * Preke.kaina) As Suma FROM UzsakymoPreke INNER JOIN Preke ON fk_Prekeid=Preke.id WHERE UzsakymoPreke.fk_Uzsakymasid IN ($sql)";
			// Bendra pinigu suma
				
			$sql =" SELECT `Preke`.`gamintojas`, `Preke`.`pavadinimas`,`Preke`.`kaina`, Sum(`UzsakymoPreke`.`kiekis`) as kiekis, Sum(`Preke`.`kiekis` * `Preke`.`kaina`) as kainaa "
                    . "FROM `Preke`"
                    . "INNER JOIN `UzsakymoPreke`"
                    . "ON `Preke`.`id`=`UzsakymoPreke`.`fk_Prekeid`"
                    . "INNER JOIN `Uzsakymas`"
                    . "ON `UzsakymoPreke`.`fk_Uzsakymasid`=`Uzsakymas`.`id`"
                    . "WHERE Uzsakymas.id IN ($sqlFilter)"
                    . "GROUP BY `Preke`.`id` ORDER BY `kainaa` DESC";
		
			if ($_POST['prekiukiekis'] != "")
				$sql = $sql." LIMIT ".$_POST['prekiukiekis'];

			#echo $sql;
		
			$conn = new mysqli($server, $user, $password, $dbname);
			   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
			mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių
			if (!$result = $conn->query($sql)) die("Negaliu įrašyti: " . $conn->error);
			#Nuskaitymas
			#if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

			echo  "<div style=\"text-align: center;color:green\"><br><br><h1>Perkamiausių prekių ataskaita.</h1></div><br>";
		

			#Išvedimas
				// parodyti
			echo "<table border=\"1\">";
		
			echo "<tr>
				<th>Gamintojas</th>
				<th>Pavadinimas</th>
				<th>Kaina vieneto</th>
				<th>Vienetų kiekis</th>
				<th>Bendra suma</th>
			</tr>";
		
			$totalsum = 0;
		
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row['gamintojas']."</td><td>".$row['pavadinimas']."</td><td>".$row['kaina']."</td><td>".$row['kiekis']."</td><td>".$row['kainaa']."</td>";
				$totalsum = $totalsum + $row['kainaa'];
				echo "</tr>";
			}
			echo "</table>";
		
			echo "<div style=\"text-align: center;color:green\"><br><br><h1>Bendrai prekių užsakyta už: $totalsum €</h1></div><br>";
		
			?>
      <?php
          }                
          else {   			 
              
              if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
              else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                   }  
   			  // jei ankstesnis puslapis perdavė $_SESSION['message']
				echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
		
                echo "<table class=\"center\"><tr><td>";
          include("include/login.php");                    // prisijungimo forma
                echo "</td></tr></table></div><br>";
           
		  }
?>
            </body>
</html>



