<?php
// index.php
// jei vartotojas prisijungęs rodomas demonstracinis meniu pagal jo rolę
// jei neprisijungęs - prisijungimo forma per include("login.php");
// toje formoje daugiau galimybių...

session_start();
include("include/functions.php");

?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Krepšelis</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
    </head>
	<script>
		function showConfirmDialog() {
			var r = confirm("Ar tikrai norite pašalinti!");
		}
	</script>
    <body>
        <table class="center" ><tr><td>
            <center><h1>Krepšelis</h1></center>
        </td></tr><tr><td> 
		<?php
           
		   if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
		   {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
											  // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
			   include("include/meniu.php");
			   inisession("part");   //   pavalom prisijungimo etapo kintamuosius
			   $_SESSION['prev']="index"; 
			   
			   //include("include/prekiuposistemesmeniu.php"); //įterpiamas meniu pagal vartotojo rolę
		   
	   ?>
	   <br>
           <div style="background-color: aqua; padding: 10px;">
				<pre><b>Pavadinimas 		Kaina			Kiekis				Suma</b></pre>
				<pre>Laidas			10.20			2				20.40		<button onclick=showConfirmDialog()>Pašalinti</button></pre>
				<pre>Ekranas			100.99			1				100.99		<button onclick=showConfirmDialog()>Pašalinti</button></pre>
				<pre>Plančetė		500.55			1				500.55		<button onclick=showConfirmDialog()>Pašalinti</button></pre>
				<button onclick="window.location.href='pirkti.php'">
					Pirkti
    			</button>
		   </div>
<?php
		   }
?>
    </body>
</html>

