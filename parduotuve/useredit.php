<?php 
// useredit.php 
// vartotojas gali pasikeisti slaptažodį ar email
// formos reikšmes tikrins procuseredit.php. Esant klaidų pakartotinai rodant formą rodomos ir klaidos

session_start();
// sesijos kontrole
if ($_SESSION['prev'] == "index")								  
	{$_SESSION['mail_login'] = $_SESSION['email'];
	$_SESSION['passn_error'] = "";      // papildomi kintamieji naujam password įsiminti
	$_SESSION['passn_login'] = ""; }  //visos kitos turetų būti tuščios
$_SESSION['prev'] = "useredit"; 
?>

 <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
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
                <div align="center">   <font size="4" color="#ff0000"><?php echo $_SESSION['message']; ?><br></font>  
					<?php  include("include/valdymomeniu.php"); ?>
      <table bgcolor=#C3FDB8>
        <tr><td>
		<form action="procuseredit.php" method="POST" class="login">             
        <center style="font-size:18pt;"><b>Slaptažodžio keitimas</b></center><br>
		<center style="font-size:14pt;"><b>Vartotojas: <?php echo $_SESSION['email'];  ?></b></center>
        
        <p style="text-align:left;">Dabartinis slaptažodis:<br>
            <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            <?php echo $_SESSION['pass_error']; ?>
        </p>
			
		<p style="text-align:left;">Naujas slaptažodis:<br>
            <input class ="s1" name="passn" type="password" value="<?php echo $_SESSION['passn_login']; ?>"><br>
            <?php echo $_SESSION['passn_error']; ?>
        </p>	
			
		<p style="text-align:left;">E-paštas:<br>
			<input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
			<?php echo $_SESSION['mail_error']; ?>
        </p> 
			
        <p style="text-align:left;">
            <input type="submit" name="login" value="Atnaujinti"/>     
        </p>  
        </form>
        </td></tr>
	 </table>
  </div>
  </td></tr>
  </table>           
 </body>
</html>
	


