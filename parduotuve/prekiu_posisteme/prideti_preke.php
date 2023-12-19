<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

if (!empty($_SESSION['email']))
{
    $email = $_SESSION['email'];

?>
<html>
<head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Pridėti prekę</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>
<body>   
    <table class="center">
        <tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr>
        <tr><td> 
            <table style="border-width: 2px; border-style: dotted;">
                <tr><td>Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php">Prekių sąrašą</a>]</td></tr>
            </table>
            <br>
            <div align="center" style="background-color: aqua; padding: 10px;">
                <form action="/Emart/parduotuve/prekiu_posisteme/prideti_prekea.php" method="post">
                    <center style="font-size:18pt;"><b>Pridėti prekę</b></center>
                    <p style="text-align:left;">Pavadinimas:<br>
                        <input type="text" name="Pavadinimas" value="" /></p>
                    <p style="text-align:left;">Kaina:<br>
                        <input type="text" name="Kaina" value="" /></p>
                    <p style="text-align:left;">Kiekis:<br>
                        <input type="text" name="Kiekis" value="" /></p>
                    <p style="text-align:left;">Gamintojas:<br>
                        <input type="text" name="Gamintojas" value="" /></p>
                    <p style="text-align:center;">
                    <input type="hidden" name="seller_email" value="<?php echo $email; ?>" />
                        <button type="submit">Išsaugoti</button>
                    </p>
                </form>
            </div>
        </td></tr>
    </table>           
</body>
</html>
<?php
}
?>