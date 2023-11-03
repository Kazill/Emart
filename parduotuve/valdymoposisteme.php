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
    <?php
        include("include/valdymomeniu.php"); //įterpiamas meniu pagal vartotojo rolę
        $email = $_SESSION['email'];
 		$db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$sql = "SELECT * "
           . "FROM " . TBL_USERS . " WHERE el_pastas='$email'";
		$result = mysqli_query($db, $sql);
		if (!$result || (mysqli_num_rows($result) < 1))  
		{
            echo "Klaida skaitant lentelę users"; 
            exit;
        }
        $row = mysqli_fetch_assoc($result);
            
        $index = $row['fk_Adresasid'];
        $sql2 = "SELECT * " . " FROM " . TBL_ADRESS . " WHERE id='$index'";
		$result2 = mysqli_query($db, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $pastas = $row2['pasto_kodas'];
        $vieta = $row2['gyvenamoji_vieta'];
    ?> 
        <div class="container">
            <h2>Profilio informacija</h2>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                    <tr>
                        <td style="width:10%">El. paštas:</td>
                        <td> <?php echo $row['el_pastas']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width:10%">Vardas:</td>
                        <td> <?php echo $row['vardas']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width:10%">Pavardė:</td>
                        <td> <?php echo $row['pavarde']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width:10%">Gimimo data:</td>
                        <td> <?php echo $row['gimimo_data']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width:10%">Tel. Nr.:</td>
                        <td> <?php echo $row['tel_nr']; ?> </td>
                    </tr>
                    <tr>
                        <td style="width:10%">Adresas:</td>
                        <td> <?php echo $pastas;echo ", ";echo $vieta; ?> </td>
                    </tr>
                </tbody>
            </table>
                <button class="btn btn-default" onclick="location.href='adresas.php'">Atnaujinti adresą</button>
                <button class="btn btn-default" onclick="location.href='redaguoti.php'">Redaguoti</button>
                <form action="istrinti.php" method="post" onsubmit="return confirm('Ar  tikrai norite ištrinti paskyrą ?');" style="display: inline;">
                    <button type="submit" class="btn btn-default">Ištrinti paskyrą</button>
                </form>
        </div>
	</body>
</html>


