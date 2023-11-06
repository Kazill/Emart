<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
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

        echo "[<a href=\"uzsakymai.php\">Užsakymų sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"prekiuposisteme.php\">Prekių sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"naudotojai.php\">Naudotojų sąrašas</a>] &nbsp;&nbsp;";
        echo "[<a href=\"prasymai.php\">Prašymai</a>] &nbsp;&nbsp;";
        echo "[<a href=\"krepselis.php\">Krepšelis</a>] &nbsp;&nbsp;";
        echo "[<a href=\"logout.php\">Atsijungti</a>]";
      echo "</td></tr></table>";
?>       
    
 