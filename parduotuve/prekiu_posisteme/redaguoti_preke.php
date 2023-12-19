<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

if (isset($_GET['id'])) {
    $Id = intval($_GET['id']); // Sanitize the input

    // Prepare a SQL query to fetch the user's data
    $query = $conn->prepare("SELECT * FROM prekes INNER JOIN pardavejai ON fk_Pardavėjasid_Pardavėjas=id_Pardavejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas WHERE id_Preke = ?");
    $query->bind_param("i", $Id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $orderData = $result->fetch_assoc();
    } else {
        echo "No order found with ID: " . $Id;
        exit; // Stop further rendering if no user is found
    }

} else {
    echo "No ID provided";
    exit; // Stop further rendering if no ID is provided
}
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
                <tr><td>Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php">Prekių sąrašą</a>]</td></tr>
            </table>
            <br>
            <div align="center" style="background-color: aqua; padding: 10px;">
                <form action="/Emart/parduotuve/redaguotiprekea.php" method="post">
                    <center style="font-size:18pt;"><b>Redaguoti prekę</b></center>
                    <p style="text-align:left;">Pavadinimas:<br>
                        <input type="text" name="Pavadinimas" value="<?php echo htmlspecialchars($orderData['pavadinimas']); ?>" /></p>
                    <p style="text-align:left;">Pardavėjas:<br>
                        <input type="text" name="Pardavejas" value="<?php echo htmlspecialchars($orderData['Vardas']); ?>" readonly /></p>
                    <p style="text-align:left;">Kaina:<br>
                        <input type="text" name="Kaina" value="<?php echo htmlspecialchars($orderData['kaina']); ?>" /></p>
                    <p style="text-align:left;">Kiekis:<br>
                        <input type="text" name="Kiekis" value="Nežinomas" /></p>
                    <p style="text-align:left;">Gamintojas:<br>
                        <input type="text" name="Gamintojas" value="<?php echo htmlspecialchars($orderData['gamintojas']); ?>" /></p>
                    <p style="text-align:center;">
                    <input type="hidden" name="id_Preke" value="<?php echo $Id; ?>" />
                        <button type="submit">Išsaugoti Pakeitimus</button>
                    </p>
                </form>
            </div>
        </td></tr>
    </table>           
</body>
</html>