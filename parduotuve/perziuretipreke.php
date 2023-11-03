<?php
// prekiuposisteme.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Peržiūrėti prekę</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
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
		$sql =  "SELECT * FROM $lentele WHERE `id`='{$_GET['id']}'";
		if (!$result = $conn->query($sql)) die("Negaliu nuskaityti: " . $conn->error);

		$row = $result->fetch_assoc();
?>
                <div style="text-align: center;color:green">
                    <br><br>
                    <h1>Peržiūrėti prekę.</h1>
                </div><br>
				<form method='post' action='redaguotiprekea.php'>
				Gamintojo suteiktas prekės kodas:<input name='id' value="<?php echo $row['id']; ?>" type='text' readonly><br><br>
				Gamintojas:<input name='gamintojas' value="<?php echo $row['gamintojas']; ?>" type='text' readonly><br><br>
				Pavadinimas:<input name='pavadinimas' value="<?php echo $row['pavadinimas']; ?>" type='text' readonly><br><br>
				Kaina:<input name='kaina' value="<?php echo $row['kaina']; ?>" type='text' readonly><br><br>
					
				Kategorija:<?php echo $row['kategorija']; echo "<br><br>" ?>

					
				Kiekis:<input name='kiekis' value="<?php echo $row['kiekis']; ?>" type='number' readonly><br><br>
				Garantija mėnesiais:<input name='garantija' value="<?php echo $row['garantija']; ?>" type='number' readonly><br><br>
				Pristatymo data geriausiu atveju:<input name='pristatymasgeriausiuatveju' value="<?php echo $row['pristatymasgeriausiuatveju']; ?>" type='date' readonly><br><br>
				Pristatymo data blogiausiu atveju:<input name='pristatymasblogiausiuatveju' value="<?php echo $row['pristatymasblogiausiuatveju']; ?>" type='date' readonly><br><br>
	</form>
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