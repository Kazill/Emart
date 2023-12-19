<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "Reikia būti prisijungus norint atsakyti į komentarus";
    exit;
}

// Retrieve the logged-in user's email from the session
$email = $_SESSION['email'];

// Handle the response submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['response'], $_POST['product_id'], $_POST['comment_id'])) {
    // Collect and sanitize input
    $responseText = mysqli_real_escape_string($conn, $_POST['response']);
    $productId = intval($_POST['product_id']);
    $commentId = intval($_POST['comment_id']); // The ID of the comment being responded to

    // Retrieve the user ID based on the email from the session
    $stmt = $conn->prepare("SELECT id_Naudotojas FROM naudotojai WHERE El_pastas = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['id_Naudotojas'];

        // Check if the user exists in the 'pirkejai' table
        $buyerCheckStmt = $conn->prepare("SELECT id_Pirkejas FROM pirkejai WHERE fk_Naudotojasid_Naudotojas = ?");
        $buyerCheckStmt->bind_param("i", $userId);
        $buyerCheckStmt->execute();
        $buyerCheckResult = $buyerCheckStmt->get_result();
        $buyerCheckStmt->close();

        if ($buyerCheckResult->num_rows > 0) {
            $buyerRow = $buyerCheckResult->fetch_assoc();
            $buyerId = $buyerRow['id_Pirkejas'];

            // Insert the response as a new comment in the Komentarai table with the parent_id set
            $insertSql = "INSERT INTO Komentarai (tekstas, data, laikas, fk_Prekeid_Preke, fk_Pirkejasid_Pirkejas, parent_id) VALUES (?, CURDATE(), CURTIME(), ?, ?, ?)";
            if ($insertStmt = $conn->prepare($insertSql)) {
                $insertStmt->bind_param("siii", $responseText, $productId, $buyerId, $commentId); 

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
}

$conn->close();
?>

<html>
<head>
    <title>Respond to Comment</title>
    <!-- Add any necessary styles or scripts -->
</head>
<body>
    <h2>Respond to Comment</h2>

    <form action="atsakymas.php?pid=<?php echo $productId; ?>&cid=<?php echo $commentId; ?>" method="post">
        <textarea name="response" required></textarea><br>
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <input type="hidden" name="comment_id" value="<?php echo $commentId; ?>">
        <input type="submit" value="Submit Response">
    </form>

</body>
</html>
