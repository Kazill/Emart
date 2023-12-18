<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); // Include your database connection file

// Check if the 'id' parameter is set in the URL
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
// Fetch the net like count (likes - dislikes) from the database
$likeQuery = $conn->prepare("
    SELECT SUM(CASE WHEN ivertis = 1 THEN 1 WHEN ivertis = -1 THEN -1 ELSE 0 END) as netLikes 
    FROM vertinimai 
    WHERE fk_Prekeid_Preke = ?");
$likeQuery->bind_param("i", $Id);
$likeQuery->execute();
$likeResult = $likeQuery->get_result();
$likeRow = $likeResult->fetch_assoc();
$netLikeCount = isset($likeRow['netLikes']) ? $likeRow['netLikes'] : 0;


?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Prekė</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>
<script>
    function confirmAction(remove, op) {
        var r = confirm("Ar tikrai norite " + op + "!");
        if (r === true) {
            window.location.replace(remove);
        }
    }
</script>

<body>
    <table class="center">
        <tr>
            <td><img src="/Emart/parduotuve/include/top.png"></td>
        </tr>
        <tr>
            <td>
                <table style="border-width: 2px; border-style: dotted;">
                    <tr>
                        <td>
                            Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/prekiu_sarasas.php">prekių sąrašą</a>]
                        </td>
                    </tr>
                </table><br>
                <div style="background-color: aqua; padding: 10px;">
                    <center><b>Prekė</b></center>
                    <p style="text-align:left;">Pavadinimas: <?php echo htmlspecialchars($orderData['pavadinimas']); ?></p>
                    <p style="text-align:left;">Kaina: <?php echo htmlspecialchars($orderData['kaina']); ?></p>
                    <p style="text-align:left;">Kategorija: <?php echo htmlspecialchars($orderData['kategorija']); ?></p>
                    <p style="text-align:left;">Gamintojas: <?php echo htmlspecialchars($orderData['gamintojas']); ?></p>
                    <p style="text-align:left;">Pardavėjas: <?php echo htmlspecialchars($orderData['Vardas']) . " " . htmlspecialchars($orderData['Pavarde']); ?></p>
                    <span id="likeCount"><?php echo $netLikeCount; ?></span> Likes
                    <br>
                    <br>
                    <!-- Like button form -->
                    <form action="ivertinimas.php" method="post">
                        <input type="hidden" name="type" value="like">
                        <input type="hidden" name="product_id" value="<?php echo $Id; ?>">
                        <input type="submit" value="Patiko">
                    </form>

                    <!-- Dislike button form -->
                    <form action="ivertinimas.php" method="post">
                        <input type="hidden" name="type" value="dislike">
                        <input type="hidden" name="product_id" value="<?php echo $Id; ?>">
                        <input type="submit" value="Nepatiko">
                    </form>
                    <button onclick="window.location.href='/Emart/parduotuve/krepselis.php'">Įdėti į krepšelį</button>
                    <button onclick="window.location.href='/Emart/parduotuve/pridetipreke.php'">Redaguoti</button>
                    <button id="commentButton">Komentuoti</button>
                    <button onclick=showConfirmDialog(null)>Pašalinti prekę</button>
                    <?php
                    if ($_SESSION['tipas'] == '1') {
                        if ($orderData['ar_paslepta'] == 0) {
                            echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/paslepti_preke.php?hide=1&id=$Id', 'Paslėpti');\">Paslėpti</button>\n";
                        } else {
                            echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/paslepti_preke.php?hide=0&id=$Id', 'Rodyti');\">Rodyti</button>\n";
                        }
                    }
                    ?>
                </div>
                <!-- Popup Form (Initially Hidden) -->
                <div id="commentFormPopup" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; border:1px solid black; z-index:100;">
                    <h3>Palikite komentarą</h3>
                    <form action="komentaras.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $Id; ?>">
                        <textarea name="comment" required></textarea>
                        <br>
                        <input type="submit" value="Pateikti">
                        <button type="button" onclick="closeCommentForm()">Atšaukti</button>
                    </form>
                </div>

                <script>
                    // JavaScript to handle the popup
                    document.getElementById("commentButton").onclick = function() {
                        document.getElementById("commentFormPopup").style.display = "block";
                    };

                    function closeCommentForm() {
                        document.getElementById("commentFormPopup").style.display = "none";
                    }
                </script>
            </td>
        </tr>
        <tr>
            <td>
                <center><b>Komentarai</b></center>
                <?php
                // Fetch top-level comments
                $topLevelCommentsSql = "SELECT k.*, n.Vardas, n.Pavarde 
                        FROM komentarai k
                        JOIN pirkejai p ON k.fk_Pirkejasid_Pirkejas = p.id_Pirkejas
                        JOIN naudotojai n ON p.fk_Naudotojasid_Naudotojas = n.id_Naudotojas
                        WHERE k.fk_Prekeid_Preke = ? AND k.parent_id IS NULL";
                if ($topLevelCommentsStmt = $conn->prepare($topLevelCommentsSql)) {
                    $topLevelCommentsStmt->bind_param("i", $Id);
                    $topLevelCommentsStmt->execute();
                    $topLevelCommentsResult = $topLevelCommentsStmt->get_result();

                    if ($topLevelCommentsResult->num_rows > 0) {
                        while ($comment = $topLevelCommentsResult->fetch_assoc()) {
                            echo "<div style='background-color: blue; border: solid; padding-bottom:10px; padding-left:10px; padding-right:10px'>";
                            echo "<p>" . htmlspecialchars($comment['Vardas']) . " " . htmlspecialchars($comment['Pavarde']) . " " . htmlspecialchars($comment['data']) . " " . htmlspecialchars($comment['laikas']) . ":</p>";
                            echo "<p style='background-color: aqua; padding: 10px; border: dashed'><i>" . htmlspecialchars($comment['tekstas']) . "</i></p>";

                            // Fetch responses to this comment
                            $responsesSql = "SELECT k.*, n.Vardas, n.Pavarde 
                                             FROM komentarai k
                                             JOIN pirkejai p ON k.fk_Pirkejasid_Pirkejas = p.id_Pirkejas
                                             JOIN naudotojai n ON p.fk_Naudotojasid_Naudotojas = n.id_Naudotojas
                                             WHERE k.parent_id = ?";
                            if ($responsesStmt = $conn->prepare($responsesSql)) {
                                $responsesStmt->bind_param("i", $comment['id_Komentaras']);
                                $responsesStmt->execute();
                                $responsesResult = $responsesStmt->get_result();

                                while ($response = $responsesResult->fetch_assoc()) {
                                    echo "<div style='background-color: lightblue; border: solid; padding-left:20px; margin-top:5px;'>";
                                    echo "<p>" . htmlspecialchars($response['Vardas']) . " " . htmlspecialchars($response['Pavarde']) . " " . htmlspecialchars($response['data']) . " " . htmlspecialchars($response['laikas']) . " (Response):</p>";
                                    echo "<p><i>" . htmlspecialchars($response['tekstas']) . "</i></p>";
                                    echo "</div>";
                                }
                                $responsesStmt->close();
                            }

                            // Display the 'Respond' button for the top-level comment
                            echo "<button onclick='respondToComment($Id, " . $comment['id_Komentaras'] . ")'>Atsakyti</button>\n";

                            if ($_SESSION['tipas'] == '1') {
                                // Admin tools
                                echo "<button onclick=\"confirmAction('/Emart/parduotuve/admin/trinti_komentara.php?pid=$Id&id=" . $comment['id_Komentaras'] . "', 'Trinti');\">Trinti</button>\n";
                            }
                            echo "</div><br>";
                        }
                    } else {
                        echo "No comments found";
                    }
                    $topLevelCommentsStmt->close();
                }
                ?>
                <!-- Response form (hidden by default) -->
                <div id="responseForm" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; border:1px solid black; z-index:100;">
                    <h3>Atsakyti į komentarą</h3>
                    <form action="atsakymas.php" method="post">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="comment_id" id="comment_id">
                        <textarea name="response" required></textarea><br>
                        <input type="submit" value="Submit Response">
                        <button type="button" onclick="closeResponseForm()">Cancel</button>
                    </form>
                </div>
            </td>
        </tr>
        <script>
            function respondToComment(productId, commentId) {
                document.getElementById('product_id').value = productId;
                document.getElementById('comment_id').value = commentId;
                document.getElementById('responseForm').style.display = 'block';
            }

            function closeResponseForm() {
                document.getElementById('responseForm').style.display = 'none';
            }
        </script>
    </table>
</body>

</html>