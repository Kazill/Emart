<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    die("Reikia būti prisijungus norint vertinti prekes");
}

// Assign the session email to a variable
$email = $_SESSION['email'];

// Check if the form's submit button is clicked
if (isset($_POST['type'], $_POST['product_id'])) {
    if ($_POST['type'] == "like") {
        $type = 1;
    }elseif ($_POST['type'] == "dislike"){
        $type = -1;
    }else{
        $type = 0;
    }
    $productId = intval($_POST['product_id']);
    // Validate that the product exists
    $productCheckStmt = $conn->prepare("SELECT id_Preke FROM prekes WHERE id_Preke = ?");
    $productCheckStmt->bind_param("i", $productId);
    $productCheckStmt->execute();
    $productCheckResult = $productCheckStmt->get_result();

    if ($productCheckResult->num_rows == 0) {
        die("The product with ID $productId does not exist.");
    }


    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id_Naudotojas FROM naudotojai WHERE El_pastas = ?");
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        $userId = $row['id_Naudotojas'];

        // Get the corresponding 'id_Pirkejas' from 'pirkejai' table
        $buyerStmt = $conn->prepare("SELECT id_Pirkejas FROM pirkejai WHERE fk_Naudotojasid_Naudotojas = ?");
        $buyerStmt->bind_param("i", $userId);
        $buyerStmt->execute();
        $buyerResult = $buyerStmt->get_result();

        if ($buyerResult->num_rows > 0) {
            $buyerRow = $buyerResult->fetch_assoc();
            $buyerId = $buyerRow['id_Pirkejas'];

            // Check if the user has already rated the product
            $checkQuery = $conn->prepare("SELECT * FROM vertinimai WHERE fk_Pirkejasid_Pirkejas = ? AND fk_Prekeid_Preke = ?");
            $checkQuery->bind_param("ii", $buyerId, $productId);
            $checkQuery->execute();
            $checkResult = $checkQuery->get_result();

            // If the user has not rated yet, insert a new rating
            if ($checkResult->num_rows == 0) {
                $insertQuery = $conn->prepare("INSERT INTO vertinimai (ivertis, fk_Pirkejasid_Pirkejas, fk_Prekeid_Preke) VALUES (?, ?, ?)");
                $insertQuery->bind_param("sii", $type, $buyerId, $productId);
                $insertQuery->execute();
            } else {
                // If the user has already rated, update the existing rating
                $updateQuery = $conn->prepare("UPDATE vertinimai SET ivertis = ? WHERE fk_Pirkejasid_Pirkejas = ? AND fk_Prekeid_Preke = ?");
                $updateQuery->bind_param("sii", $type, $buyerId, $productId);
                $updateQuery->execute();
            }
        } else {
            echo "Šis vartotojas nėra pirkėjas";
            exit;
        }
    } else {
        // Handle the case where no user is found
        echo "Vartotojas nerastas su duotu el. paštu";
        exit;
    }

    // Redirect back to the product page
    header('Location: /Emart/parduotuve/prekiu_posisteme/preke.php?id=' . $productId);
    exit;
} else {
    // Redirect back to the home page if the form wasn't submitted properly
    header('Location: /Emart/parduotuve/index.php');
    exit;
}
