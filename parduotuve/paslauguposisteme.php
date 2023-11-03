<?php
// operacija2.php
// tiesiog rodomas  tekstas ir nuoroda atgal


session_start();
include("include/functions.php");

set_time_limit(0);
ini_set('mysql.connect_timeout','0');
ini_set('max_execution_time', '0');

//if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
//{ header("Location: logout.php");exit;}

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Paslaugų posistemė</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <table class="center" ><tr><td> <center><img src="include/Paslauguposistemestop.png"></center> </td></tr><tr><td>


<?php
           
    if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/paslauguposistemesmeniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
 <?php
	#Prisijungimas

			$server=DB_SERVER;
			$user=DB_USER;
			$password=DB_PASS;
			$dbname=DB_NAME;

			$conn = new mysqli($server, $user, $password, $dbname);
			   if ($conn->connect_error) die("Negaliu prisijungti: " . $conn->connect_error);
			mysqli_set_charset($conn,"utf8");// dėl lietuviškų raidžių

			#Nuskaitymas
			$sql =  "SELECT * FROM $lentele";
			if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);
	echo"</tr>";
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

      <table style="border-width: 2px; border-style: dotted;"><tr><td>
        Atgal į [<a href="index.php">Pradžia</a>]
      </td></tr></table><br>
			
		<div style="text-align: center;color:green"> <br><br>
           <h1>Paslaugų posistemė</h1>
     </div><br>

	</body>
</html>
