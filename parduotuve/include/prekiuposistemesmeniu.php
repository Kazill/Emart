<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['email'];
$userlevel=$_SESSION['tipas'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     	echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė: <b>".$role."</b> <br>";
        echo "</td></tr><tr><td>";
        echo "[<a href=\"prekiuposisteme.php\">Visos prekės</a>] &nbsp;&nbsp;";
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
            echo "[<a href=\"pridetipreke.php\">Pridėti prekę</a>] &nbsp;&nbsp;";
       	}
		echo "[<a href=\"ieskotiprekes.php\">Ieškoti prekės</a>] &nbsp;&nbsp;";
		echo "[<a href=\"perkamiausiosprekes.php\">Sudaryti perkamiausių prekių ataskaitą</a>] &nbsp;&nbsp;";
     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        echo "[<a href=\"index.php\">Pagrindinis langas</a>]";
      echo "</td></tr></table>";
?>       
    
 