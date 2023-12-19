<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "Reikia būti prisijungus norint komentuoti";
    exit;
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $commentText = mysqli_real_escape_string($conn, $_POST['comment']);
    $productId = intval($_POST['product_id']);

    // Prepare the SQL statement to prevent SQL injection for user retrieval
    $stmt = $conn->prepare("SELECT id_Naudotojas FROM naudotojai WHERE El_pastas = ?");
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        $userId = $row['id_Naudotojas'];

        // Check if the user exists in the 'pirkejai' table
        $buyerCheckStmt = $conn->prepare("SELECT id_Pirkejas FROM pirkejai WHERE fk_Naudotojasid_Naudotojas = ?");
        $buyerCheckStmt->bind_param("i", $userId);
        $buyerCheckStmt->execute();
        $buyerCheckResult = $buyerCheckStmt->get_result();

        if ($buyerCheckResult->num_rows > 0) {
            $buyerRow = $buyerCheckResult->fetch_assoc();
            $buyerId = $buyerRow['id_Pirkejas'];

            // Prepare SQL to insert comment
            $insertSql = "INSERT INTO komentarai (tekstas, data, laikas, fk_Prekeid_Preke, fk_Pirkejasid_Pirkejas) VALUES (?, CURDATE(), CURTIME(), ?, ?)";
            if ($insertStmt = $conn->prepare($insertSql)) {
                $insertStmt->bind_param("sii", $commentText, $productId, $buyerId);

                // Execute and check if successful
                if ($insertStmt->execute()) {
                    // Redirect back to the product page
                    header("Location: /Emart/parduotuve/prekiu_posisteme/preke.php?id=" . $productId);
                    exit;
                } else {
                    echo "Error: " . $insertStmt->error;
                }

                $insertStmt->close();
            }
        } else {
            echo "Šis vartotojas nėra pirkėjas";
            exit;
        }
    } else {
        echo "Vartotojas nerastas su duotu el. paštu";
        exit;
    }
    $stmt->close();
}
$conn->close();
?>
