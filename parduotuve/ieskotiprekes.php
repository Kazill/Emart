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
        <title>Ieškoti prekės</title>
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
?>
                <div style="text-align: center;color:green">
                    <br><br>
                    <h1>Ieškoti prekės.</h1>
                </div><br>
				<form method='post' action='ieskotiprekesa.php'>
				Ieškomos prekės pavadinimas:<input name='prekespav' type='text'><br><br>
				<input type='submit' name='JJJJ' value='Ieškoti'>
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