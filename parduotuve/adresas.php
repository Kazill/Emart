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
			<h2>Adreso atnaujinimas</h2>
		  	<form method="POST">
				<div class="form-group">
					<label for="pastas" style="width:10%">Pašto kodas:</label>
					<input type="text" class="form-inline" name="pasto_kodas">
				</div>
				<div class="form-group">
			  		<label for="vieta" style="width:10%">Gyvenamoji vieta:</label>
			  		<input type="text" class="form-inline" name="gyv_vieta">
				</div>
				<button type="submit" name="submit" class="btn btn-default">Patvirtinti</button>
		  </form>
		</div>
		<?php
			if(isset($_POST['submit'])){
				//echo var_dump($_POST);
				$email = $_SESSION['email'];
				
				$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
				
				$pastas = $_POST['pasto_kodas'];
				$vieta = $_POST['gyv_vieta'];
				$sql = "INSERT INTO " . TBL_ADRESS . " (pasto_kodas,gyvenamoji_vieta) VALUES ('$pastas', '$vieta')";
				mysqli_query($db, $sql);
				
				$sql = "SELECT * " . " FROM " . TBL_ADRESS . " WHERE pasto_kodas='$pastas'";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_assoc($result);
				//echo var_dump($row);
				$index = $row['id'];
				$sql = "UPDATE " . TBL_USERS . "
					 SET fk_Adresasid='$index' WHERE el_pastas='$email'";
				mysqli_query($db, $sql);
				
				header("Location:valdymoposisteme.php");
			}
    	?> 
		</table>
	</body>
</html>




