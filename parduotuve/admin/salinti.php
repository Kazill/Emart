<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $level = $_GET['level'];
 try{
    if($level==1){
        $sql = "SELECT id_Pirkejas as pirkejas, id_Uzsakymas as uzsakymas, id_Uzsakymo_prekė as preke FROM pirkejai INNER JOIN uzsakymai ON fk_Pirkejasid_Pirkejas = id_Pirkejas LEFT JOIN uzsakymo_prekes ON fk_Uzsakymasid_Uzsakymas=id_Uzsakymas WHERE fk_Naudotojasid_Naudotojas='{$id}';"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql);

        if ($result = $conn->query($sql) && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
            if($row['preke'] != null){
            $sql = "DELETE FROM uzsakymo_prekes WHERE id_Uzsakymo_prekė='{$row['preke']}'";
            if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
            }
            if($row['uzsakymas'] != null){
            $sql = "DELETE FROM uzsakymai WHERE id_Uzsakymas='{$row['uzsakymas']}'";
            if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
            }
            }
        }

        $sql = "DELETE FROM adresai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
        if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
        $sql = "DELETE FROM pirkejai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
        if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
    }
    else if($level==2){
            $sql = "DELETE FROM adresai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
            if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
            $sql = "DELETE FROM pardavejai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
            if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
        
    }
    else if($level==3){
        $sql = "DELETE FROM adresai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
        if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
        $sql = "DELETE FROM administratoriai WHERE `fk_Naudotojasid_Naudotojas`='{$id}'";
        if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
    }

    $sql = "DELETE FROM naudotojai WHERE `id_Naudotojas`='{$id}'";
    if (!$result = $conn->query($sql)) die("Operation failed: " . $conn->error);
}
    catch(Exception $e){
        $_SESSION['message'] =  "Panaikinti naudotojo neglima";
    }
    if($_SESSION['prev'] == 'prasymai')
    {
        header("Location:/Emart/parduotuve/admin/prasymai.php");exit; 
    }
    header("Location:/Emart/parduotuve/naudotojas/naudotojai.php");exit; 

} else {
    echo "No user ID provided";
    exit; // Stop further rendering if no ID is provided
}
?>