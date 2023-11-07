<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
$email=$_SESSION['email'];
$userlevel=$_SESSION['tipas'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$email."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";

        echo "[<a href=\"/Emart/parduotuve/uzsakymai.php\">Užsakymų sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/prekiu_posisteme/perziureti_prekiu_sarasa.php\">Prekių sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/naudotojas/naudotojai.php\">Naudotojų sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/prasymai.php\">Prašymai</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/krepselis.php\">Krepšelis</a>] &nbsp;&nbsp;";
        echo "[<a href=\"/Emart/parduotuve/logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 