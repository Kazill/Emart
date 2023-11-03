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
			$server=DB_SERVER;
			$user=DB_USER;
			$password=DB_PASS;
			$dbname=DB_NAME;
			$lentele="Preke";

			$conn = new mysqli($server, $user, $password, $dbname);
			   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
			mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

			#Nuskaitymas
			$sql =  "SELECT * FROM $lentele WHERE pavadinimas LIKE '%".$_POST['prekespav']."%';";
			if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

			echo  "<div style=\"text-align: center;color:green\"><br><br><h1>Paieškos rezultatai.</h1></div><br>";
		

			#Išvedimas
				// parodyti
			echo "<table border=\"1\">";
		
			echo "<tr>
				<th>Gamintojas</th>
				<th>Kodas</th>
				<th>Kaina</th>
				<th>Kategorija</th>
				<th>Kiekis</th>
				<th>Garantija</th>
				<th>Data nuo</th>
				<th>Data iki</th>
				
			</tr>";
		
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>".$row['gamintojas']."</td><td>".$row['id']."</td><td>".$row['kaina']."</td><td>".$row['kategorija']."</td><td>".$row['kiekis'].
					"</td><td>".$row['garantija']."</td><td>".$row['pristatymasgeriausiuatveju']."</td><td>".$row['pristatymasblogiausiuatveju']."</td>";
				if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
					echo "<td><a href='perziuretipreke.php?id={$row['id']}' title=''>Peržiūrėti</a></td>";
					echo "<td><a href='#' onclick='showConfirmDialog(\"{$row['id']}\"); return false;' title=''>Šalinti</a></td>";
					echo "<td><a href='redaguotipreke.php?id={$row['id']}' title=''>Redaguoti</a></td>";
       			}
				echo "</tr>";
			}
			echo "</table>";
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


