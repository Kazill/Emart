<?php 
// login.php - tai prisijungimo forma, index.php puslapio dalis 
// formos reikšmes tikrins proclogin.php. Esant klaidų pakartotinai rodant formą rodomos klaidos
// formos laukų reikšmės ir klaidų pranešimai grįžta per sesijos kintamuosius
// taip pat iš čia išeina priminti slaptažodžio.
// perėjimas į registraciją rodomas jei nustatyta $uregister kad galima pačiam registruotis

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
$_SESSION['prev'] = "login";
include("include/nustatymai.php");
?>

		<form action="proclogin.php" method="POST" class="login">             
        <center style="font-size:18pt;"><b>Prisijungimas</b></center>
        <p style="text-align:left;">El. pašto adresas:<br>
            <input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login'];  ?>"/><br>
            <?php echo $_SESSION['mail_error']; 
			?>
        </p>
        <p style="text-align:left;">Slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
            <?php echo $_SESSION['pass_error']; 
			?>
        </p>  
        <p style="text-align:left;">
            <input type="submit" name="login" value="Prisijungti"/>   
        </p>
        <p>
 <?php
			 echo "<a href=\"register.php\">Registracija</a>";
?>
        </p>     
    </form>
	


