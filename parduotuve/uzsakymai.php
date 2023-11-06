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
        <title>Užsakymai</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
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
            <center><h1>Užsakymai</h1></center>
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
				<p>id: 5</p>
				<p>Pirkėjas: Tomas</p>
				<p>Pardavėjas: Matas</p>
				<button onclick="window.location.href='uzsakymas.php'">
					Peržiūrėti
    			</button>
		   </div>
<?php
		   }
?>
    </body>
</html>

