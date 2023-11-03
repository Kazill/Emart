<?php
// meniu.php rodomas meniu pagal vartotojo role



if(!isset($_SESSION)) {header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['email'];
$userlevel=$_SESSION['tipas'];
$role="";
{foreach($user_roles as $x=>$x_value)
				{if($x_value==$userlevel) $role=$x;}
}
	echo "<table width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
	echo "<tr><td>";
	//echo "Prisijungęs vartotojas: <b>".$user."</b>     Rolė:<b>.$role."</b><br>";
	echo "</td></tr><tr><td>";
	echo "[<a href=\"paslauguposisteme.php\">Visi užsakymai</a>]&nbsp;&nbsp;";
	echo "[<a href=\"atsauktiuzsakyma.php\">Atšaukti užsakymą</a>]&nbsp;&nbsp;";
	echo "[<a href=\"redaguotiuzsakyma.php\">Redaguoti užsakymo sudėtį</a>]&nbsp;&nbsp;";
	echo "[<a href=\"administruotiperziura.php\">Administruoti užsakymo peržiūrą</a>]&nbsp;&nbsp;";
	echo "[<a href=\"buklesperziura.php\">Užsakymo būklės peržiūra</a>]&nbsp;&nbsp;";
	echo "[<a href=\"mokejimobudai.php\">Administruoti užsakymo mokėjimo metodus</a>]&nbsp;&nbsp;";
	echo "[<a href=\"uzsakymoataskaita.php.php\">Sudaryti užsakymo ataskaitą</a>]&nbsp;&nbsp;";
	echo "[<a href=\"index.php\">Pagrindinis langas</a>]";
      echo "</td></tr></table>";
?>       
	