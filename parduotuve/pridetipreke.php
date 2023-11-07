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
        <title>Pridėti prekę</title>
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
        include("include/meniu.php");
        include("include/prekiuposistemesmeniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
                <div style="text-align: center;color:green">
                    <br><br>
                    <h1>Pridėti prekę.</h1>
                </div><br>
				<form method='post' action='pridetiprekea.php'>
				Gamintojo suteiktas prekės kodas:<input name='id' type='text' required><br><br>
				Gamintojas:<input name='gamintojas' type='text' required><br><br>
				Pavadinimas:<input name='pavadinimas' type='text' required><br><br>
				Kaina:<input name='kaina' type='text' required><br><br>
					
				Kategorija:<select name=kategorija>
					<option value="CPU">CPU</option>
					<option value="GPU">GPU</option>
					<option value="RAM">RAM</option>
				</select><br><br>

					
				Kiekis:<input name='kiekis' type='number' required><br><br>
				Garantija mėnesiais:<input name='garantija' type='number' required><br><br>
				Pristatymo data geriausiu atveju:<input name='pristatymasgeriausiuatveju' type='date' required><br><br>
				Pristatymo data blogiausiu atveju:<input name='pristatymasblogiausiuatveju' type='date' required><br><br>
				<input type='submit' name='JJJJ' value='Pridėti'>
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
