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
        <title>Profilio peržiūra</title>
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
    	<?php include("include/valdymomeniu.php"); //įterpiamas meniu pagal vartotojo rolę ?>
        <div class="container">
			<h2>Profilio redagavimas</h2>
		  	<form method="POST">
				<div class="form-group">
					<label for="email" style="width:10%">El. paštas:</label>
					<input type="email" class="form-inline" name="email">
				</div>
				<div class="form-group">
			  		<label for="vardas" style="width:10%">Vardas:</label>
			  		<input type="text" class="form-inline" name="vardas">
				</div>
				<div class="form-group">
					<label for="pavarde" style="width:10%">Pavarde:</label>
					<input type="text" class="form-inline" name="pavarde">
				</div>
				<div class="form-group">
					<label for="data" style="width:10%">Gimimo data:</label>
					<input type="date" class="form-inline" name="data">
				</div>
				<div class="form-group">
					<label for="tel" style="width:10%">Tel. Nr.:</label>
					<input type="text" class="form-inline" name="tel">
				</div>
				<button type="submit" name="submit" class="btn btn-default">Patvirtinti</button>
		  </form>
		</div>
		<?php
			if(isset($_POST['submit'])){
				//echo var_dump($_POST);
				$email = $_SESSION['email'];
				
				$mail = $_POST['email'];
				$vard = $_POST['vardas'];
				$pav = $_POST['pavarde'];
				$gimdata = $_POST['data'];
				$telnr = $_POST['tel'];
				
				$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
				$sql = "UPDATE " . TBL_USERS . "
					 SET el_pastas='$mail', vardas='$vard', pavarde='$pav', gimimo_data='$gimdata', tel_nr='$telnr' 
					 WHERE el_pastas='$email'";
				mysqli_query($db, $sql);
				$_SESSION['email'] = $mail;
				header("Location:valdymoposisteme.php");
			}
    	?> 
		</table>
	</body>
</html>



