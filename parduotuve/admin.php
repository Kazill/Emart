<?php
// admin.php
// vartotojų įgaliojimų keitimas ir naujo vartotojo registracija, jei leidžia nustatymai
// galima keisti vartotojų roles, tame tarpe uzblokuoti ir/arba juos pašalinti
// sužymėjus pakeitimus į procadmin.php, bus dar perklausta

session_start();
include("include/nustatymai.php");
include("include/functions.php");
// cia sesijos kontrole
$_SESSION['prev']="admin";
date_default_timezone_set("Europe/Vilnius");
?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Administratoriaus sąsaja</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <table class="center" ><tr><td>
        	<div style="text-align: center;color:black">
        		<br><br>
                <h1>Naudotojų valdymo posistemė</h1>
            </div><br>
        </td></tr><tr><td> 
		<center><font size="5">Vartotojų registracija, peržiūra ir įgaliojimų keitimas</font></center></td></tr></table> <br>
		<center><b><?php echo $_SESSION['message']; ?></b></center>
		<form name="vartotojai" action="procadmin.php" method="post">
	    <table class="center" style=" width:40%; border-width: 2px; border-style: dotted;">
		         <tr><td width=30%><a href="valdymoposisteme.php">[Atgal]</a></td><td width=30%>
                     
	<?php
		   if ($uregister != "self") echo "<a href=\"register.php\"><b>Registruoti naują vartotoją<b></a><td>";
		   else echo "</td>";
	?>
		   
			<td width="30%">Atlikite reikalingus pakeitimus ir</td><td width="10%"> <input type="submit" value="Vykdyti"></td></tr></table> <br> 
<?php
	$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	$sql = "SELECT * "
            . "FROM " . TBL_USERS . " ORDER BY tipas DESC,el_pastas";
	$result = mysqli_query($db, $sql);
	if (!$result || (mysqli_num_rows($result) < 1))  
			{echo "Klaida skaitant lentelę users"; exit;}
?>
    <table class="center"  border="1" cellspacing="0" cellpadding="3">
    <tr>
        <td>
            <b>Vartotojo vardas</b>
        </td>
        <td>
            <b>Rolė</b>
        </td>
        <td>
            <b>E-paštas</b>
        </td>
        <td>
            <b>Šalinti?</b>
        </td>
    </tr>
<?php
        while($row = mysqli_fetch_assoc($result)) 
	{	 
	  	$user= $row['vardas'];
	  	$pavarde= $row['pavarde'];
	  	$email = $row['el_pastas'];
	  	$data = $row['gimimo_data'];
	  	$tel = $row['tel_nr'];
	    $level=$row['tipas'];
	    $adresas=$row['fk_Adresasid'];
            
      	echo "<tr><td>".$user. "</td><td>";
    	echo "<select name=\"role_".$email."\">";
      	$yra=false;
		foreach($user_roles as $x=>$x_value)
  			{echo "<option ";
        	 if ($x_value == $level) {$yra=true;echo "selected ";}
             echo "value=\"".$x_value."\" ";
         	 echo ">".$x."</option>";
        	 }
		if (!$yra)
        {echo "<option selected value=".$level.">Neegzistuoja=".$level."</option>";}
        $UZBLOKUOTAS=UZBLOKUOTAS; echo "<option ";
        if ($level == UZBLOKUOTAS) echo "selected ";
          echo "value=".$UZBLOKUOTAS." ";
        echo ">Užblokuotas</option>";      // papildoma opcija
      echo "</select></td>";
          
      echo "<td>".$email."</td>";
      echo "<td><input type=\"checkbox\" name=\"naikinti_".$user."\">";
   }
?>
        </table>
        <br> <input type="submit" value="Vykdyti">
        </form>
    </body></html>
