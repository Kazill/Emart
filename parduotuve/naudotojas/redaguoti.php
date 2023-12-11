<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the user ID is provided and is a valid number
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $userId = intval($_GET['id']);

    // Prepare a SQL query to fetch the user's data
    $query = $conn->prepare("SELECT Vardas, Pavarde, El_pastas, Slaptazodis, Ar_blokuotas FROM naudotojai WHERE id_Naudotojas = ?");
    $query->bind_param("i", $userId); // "i" for integer
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        // Now $userData will have the user's data
    } else {
        // No user found with the given ID, handle this case appropriately
        $_SESSION['message'] = "Naudotojas su tokiu ID nerastas.";
        header("Location: /Emart/parduotuve/naudotojas/naudotojai.php");
        exit;
    }
    $query->close();
} else {
    // The ID is not provided or is invalid, handle this case appropriately
    $_SESSION['message'] = "Nepateiktas teisingas naudotojo ID.";
    header("Location: /Emart/parduotuve/naudotojas/naudotojai.php");
    exit;
}

// Continue to the HTML with $userData populated from the database
?>

<!DOCTYPE html>
<html lang="lt">
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
                <form action="/Emart/parduotuve/naudotojas/update_user.php" method="post">
                    <center style="font-size:18pt;"><b>Redaguoti Naudotoją</b></center>
                    <p style="text-align:left;">Vardas:<br>
                        <input type="text" name="Vardas" value="<?php echo htmlspecialchars($userData['Vardas'] ?? ''); ?>" /></p>
                    <p style="text-align:left;">Pavardė:<br>
                        <input type="text" name="Pavarde" value="<?php echo htmlspecialchars($userData['Pavarde'] ?? ''); ?>" /></p>
                    <p style="text-align:left;">El. paštas:<br>
                        <input type="email" name="Email" value="<?php echo htmlspecialchars($userData['El_pastas'] ?? ''); ?>" readonly /></p>
                    <p style="text-align:left;">Slaptažodis:<br>
                        <input type="password" name="Password" /></p> <!-- Do not prefill passwords -->
                    <p style="text-align:left;">Ar blokuotas:<br>
                        <input type="text" name="ArBlokuotas" value="<?php echo htmlspecialchars($userData['Ar_blokuotas'] ?? ''); ?>" /></p>
                    <input type="hidden" name="id_Naudotojas" value="<?php echo $userId; ?>" />
                    <p style="text-align:center;">
                        <button type="submit">Išsaugoti Pakeitimus</button>
                    </p>
                </form>
            </div>
        </td></tr>
    </table>
</body>
</html>