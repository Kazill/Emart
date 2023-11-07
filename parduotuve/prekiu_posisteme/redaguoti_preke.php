<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");

// Fetch user details from session or a database query
// Assuming $itemData is an array holding user information
$itemData = array(
    'Pavadinimas' => 'Laidas',
    'Pardavejas' => 'Petras',
    'Kaina' => '10.20',
    'Kiekis' => 150,
    'Gamintojas' => 'Gamintojas' // 'Taip' or 'Ne'
);
?>
<html>
<head>  
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
    <title>Redaguoti prekę</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>
<body>   
    <table class="center">
        <tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr>
        <tr><td> 
            <table style="border-width: 2px; border-style: dotted;">
                <tr><td>Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/perziureti_prekiu_sarasa.php">Prekių sąrašą</a>]</td></tr>
            </table>
            <br>
            <div align="center" style="background-color: aqua; padding: 10px;">
                <form action="/Emart/parduotuve/prekiu_posisteme/preke1.php" method="post">
                    <center style="font-size:18pt;"><b>Redaguoti prekę</b></center>
                    <p style="text-align:left;">Pavadinimas:<br>
                        <input type="text" name="Pavadinimas" value="<?php echo htmlspecialchars($itemData['Pavadinimas']); ?>" /></p>
                    <p style="text-align:left;">Pardavėjas:<br>
                        <input type="text" name="Pardavejas" value="<?php echo htmlspecialchars($itemData['Pardavejas']); ?>" /></p>
                    <p style="text-align:left;">Kaina:<br>
                        <input type="text" name="Kaina" value="<?php echo htmlspecialchars($itemData['Kaina']); ?>" /></p>
                    <p style="text-align:left;">Kiekis:<br>
                        <input type="text" name="Kiekis" value="<?php echo htmlspecialchars($itemData['Kiekis']); ?>" /></p>
                    <p style="text-align:left;">Gamintojas:<br>
                        <input type="text" name="Gamintojas" value="<?php echo htmlspecialchars($itemData['Gamintojas']); ?>" /></p>
                    <p style="text-align:center;">
                        <button type="submit">Išsaugoti Pakeitimus</button>
                    </p>
                </form>
            </div>
        </td></tr>
    </table>           
</body>
</html>