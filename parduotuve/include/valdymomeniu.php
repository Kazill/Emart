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

        echo "[<a href=\"index.php\">Pagrindinis langas</a>]&nbsp;&nbsp;";
        echo "[<a href=\"valdymoposisteme.php\">Profilio peržiūra</a>]&nbsp;&nbsp;";
        echo "[<a href=\"useredit.php\">Keisti slaptažodį</a>] &nbsp;&nbsp;";
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"admin.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
       	}
	if (($userlevel == $user_roles["Darbuotojas"]) || ($userlevel == $user_roles[ADMIN_LEVEL] )) {
            echo "[<a href=\"sarasas.php\">Rodyti naudotojų sąrašą</a>] &nbsp;&nbsp;";
       	}  
        echo "[<a href=\"logout.php\">Atsijungti</a>]";

      echo "</td></tr></table>";
?>       
    
 