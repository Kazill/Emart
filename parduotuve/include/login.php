<?php 
// login.php - tai prisijungimo forma
session_start();
if (!isset($_SESSION)) { 
    header($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/logout.php");
    exit;
}

if (!isset($_SESSION['prev'])) {
    $_SESSION['prev'] = "login";
}

include(__DIR__ . "/nustatymai.php");


// Pradinių sesijos kintamųjų nustatymas
if (!isset($_SESSION['mail_login'])) $_SESSION['mail_login'] = '';
if (!isset($_SESSION['mail_error'])) $_SESSION['mail_error'] = '';
if (!isset($_SESSION['pass_login'])) $_SESSION['pass_login'] = '';
if (!isset($_SESSION['pass_error'])) $_SESSION['pass_error'] = '';
?>

<form action="proclogin.php" method="POST" class="login">             
    <center style="font-size:18pt;"><b>Prisijungimas</b></center>
    <p style="text-align:left;">El. pašto adresas:<br>
        <input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"/><br>
        <?php echo $_SESSION['mail_error']; ?>
    </p>
    <p style="text-align:left;">Slaptažodis:<br>
        <input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"/><br>
        <?php echo $_SESSION['pass_error']; ?>
    </p>  
    <p style="text-align:left;">
        <input type="submit" name="login" value="Prisijungti"/>   
    </p>
    <p>
        <a href="register.php">Registracija</a>
    </p>     
</form>
