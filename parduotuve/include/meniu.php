<?php
// After starting the session, you can now check if specific session variables are set.
if (!isset($_SESSION['email']) || !isset($_SESSION['tipas'])) {
    // If the required session variables are not set, redirect to the logout page.
    header("Location: /Emart/parduotuve/logout.php");
    exit;
}
// meniu.php  rodomas meniu pagal vartotojo rolę
if (!isset($_SESSION)) { header($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/logout.php");exit;}
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
$email=$_SESSION['email'];
$userlevel=$_SESSION['tipas'];
$role="";
$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
  "Undefined"=>"0",
	"Administratorius"=>"1",
	"Darbuotojas"=>"2",
	"Klientas"=>"3",);
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$email."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";

        echo "[<a href=\"/Emart/parduotuve/admin/uzsakymai.php\">Užsakymų sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/prekiu_posisteme/perziureti_prekiu_sarasa.php\">Prekių sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/naudotojas/naudotojai.php\">Naudotojų sąrašas</a>] &nbsp;&nbsp;";
        if($_SESSION['uLevel']=='3')
        {
        echo "[<a href=\"/Emart/parduotuve/admin/prasymai.php\">Prašymai</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"/Emart/parduotuve/krepselis.php\">Krepšelis</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 