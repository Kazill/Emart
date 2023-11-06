<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");

// Fetch user details from session or a database query
// Assuming $userData is an array holding user information
$userData = array(
    'Vardas' => 'Tomas',
    'Pavarde' => 'Tomaitis',
    'Email' => 'tomaitis@gmail.com',
    'Password' => '',
    'ArBlokuotas' => 'Ne' // 'Taip' or 'Ne'
);
?>
<html>
<head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Redaguoti Naudotoją</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>
<body>   
    <table class="center">
        <tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr>
        <tr><td> 
            <table style="border-width: 2px; border-style: dotted;">
                <tr><td>Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]</td></tr>
            </table>
            <br>
            <div align="center" style="background-color: aqua; padding: 10px;">
                <form action="/Emart/parduotuve/naudotojas/tomas.php" method="post">
                    <center style="font-size:18pt;"><b>Redaguoti Naudotoją</b></center>
                    <p style="text-align:left;">Vardas:<br>
                        <input type="text" name="Vardas" value="<?php echo htmlspecialchars($userData['Vardas']); ?>" /></p>
                    <p style="text-align:left;">Pavardė:<br>
                        <input type="text" name="Pavarde" value="<?php echo htmlspecialchars($userData['Pavarde']); ?>" /></p>
                    <p style="text-align:left;">El. paštas:<br>
                        <input type="email" name="Email" value="<?php echo htmlspecialchars($userData['Email']); ?>" /></p>
                    <p style="text-align:left;">Slaptažodis:<br>
                        <input type="text" name="Password" value="<?php echo htmlspecialchars($userData['Password']); ?>" /></p>
                    <p style="text-align:left;">Ar blokuotas:<br>
                        <input type="text" name="ArBlokuotas" value="<?php echo htmlspecialchars($userData['ArBlokuotas']); ?>" /></p>
                    <p style="text-align:center;">
                        <button type="submit">Išsaugoti Pakeitimus</button>
                    </p>
                </form>
            </div>
        </td></tr>
    </table>           
</body>
</html>
