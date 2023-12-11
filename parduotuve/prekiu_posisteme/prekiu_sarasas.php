<?php 

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php"); 

?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Prekės</title>
        <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
    </head>
    <body>
    <table class="center" ><tr><td>
            <center><h1>Prekės</h1></center>
            </td></tr><tr><td>
            
<?php
           
    if (!empty($_SESSION['email']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
        echo "<center style='color: red'>".$_SESSION['message']."</center>";
        $_SESSION['message']='';
        include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/meniu.php");
        inisession("part");
        $_SESSION['prev']="prekiu_sarasas"; 
                                       // Your user list logic starts here
        $sql = "SELECT * FROM prekes INNER JOIN pardavejai ON fk_Pardavėjasid_Pardavėjas=id_Pardavejas INNER JOIN naudotojai ON fk_Naudotojasid_Naudotojas=id_Naudotojas"; // Replace 'users' with your actual table name
        $result = mysqli_query($conn, $sql); // Assuming $conn is your database connection variable
        ?>
                <div style="background-color: aqua; padding: 10px;">
				<pre><b>Pavadinimas 		Kaina 		Pardavėjas 	Daugiau </b></pre>
                <?php               
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<pre>". htmlspecialchars($row['pavadinimas'])."			".htmlspecialchars($row['kaina'])." 		".htmlspecialchars($row['Vardas'])." ".htmlspecialchars($row['Pavarde'])." 	<button onclick=\"window.location.href='preke1.php'\">Peržiūrėti</button></pre>";
            }
            } else {
                    
                echo "Not found";
            }
                                       // User list logic ends here
            } else {
                                       // Code for users who are not logged in
                if (!isset($_SESSION['prev'])) inisession("full");             
                else {if ($_SESSION['prev'] != "proclogin") inisession("part");}  
                echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
                echo "<table class=\"center\"><tr><td>";
                include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/login.php"); // Login form
                echo "</td></tr></table></div><br>";
             }
            ?>
            <button onclick="window.location.href='../pridetipreke.php'">Įtraukti prekę</button>
		   </div>
            </td></tr></table>
        </body>
</html>
	

