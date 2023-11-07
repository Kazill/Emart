<?php 

session_start();
include("../include/functions.php");

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Prekės</title>
        <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
    </head>
	<script>
		function showConfirmDialog(removeId) {
			var r = confirm("Ar tikrai norite pašalinti!");
			if (r === true) {
				window.location.replace("salintipreke.php?id=" + removeId);
			}
		}
	</script>
    <body>
    <table class="center" ><tr><td>
            <center><h1>Prekės</h1></center>
            </td></tr><tr><td>
<?php
           
    if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/meniu.php");
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
		
        include("../include/prekiuposistemesmeniu.php"); //įterpiamas meniu pagal vartotojo rolę
?>
			
             
           <div style="background-color: aqua; padding: 10px;">
				<pre><b>Pavadinimas 		Kaina 		Pardavėjas 	Daugiau </b></pre>
				<pre>Laidas			10.20 		Petras 		<button onclick="window.location.href='preke1.php'">Peržiūrėti</button></pre>
				<pre>Ekranas  		100.99 		Antanas 	<button onclick="window.location.href='preke1.php'">Peržiūrėti</button></pre>
				<pre>Plančetė		500.55 		Juozas 		<button onclick="window.location.href='preke1.php'">Peržiūrėti</button></pre>
                <br>
                <button onclick="window.location.href='../pridetipreke.php'">Įtraukti prekę</button>
		   </div>
<?php
        }
?>
        </body>
</html>

