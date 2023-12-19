<?php
session_start();
include("include/nustatymai.php");
include("include/functions.php");
?>
<html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Užsąkymas</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
            <script>
		function showConfirmDialogCancel() {
			var r = confirm("Ar tikrai norite atšaukti užsąkymą!");
            if (r === true) {
				window.location.replace("krepselis.php?");
			}
		}
        function showConfirmDialogBuy() {
			var r = confirm("Ar tikrai norite patvirtinti užsąkymą!");
		}
	</script>
        </head>
        <body>   
                    <table class="center"><tr><td><img src="include/top.png"></td></tr><tr><td> 
								<div align="center" style="background-color: aqua; padding: 10px;">
                    			<table> <tr><td>           
                                <center style="font-size:18pt;"><b>Užsąkymas</b></center>
                                <p style="text-align:left;">Prekės:<br></p>
<?php
// Duomenų bazės prisijungimo informacija
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'isp';

// Sukuriamas prisijungimas prie duomenų bazės
$conn = new mysqli($server, $user, $password, $dbname);
            $sql= "SELECT * 
            FROM uzsakymo_prekes AS uz 
            LEFT JOIN prekes AS p ON p.id_Preke = uz.fk_Prekeid_Preke 
            LEFT JOIN uzsakymai AS u ON uz.fk_Uzsakymasid_Uzsakymas = u.id_Uzsakymas
            ";
            $stmt = $conn->query($sql);  
                
            
            if($stmt){
                while ($item = $stmt->fetch_assoc()) {
                    $suma = $item['kaina'] * $item['kiekis'];
              
                    echo "<pre>".$item['pristatymo_budas'] ."\t".$item['kiekis'] . "\t". $suma."\t";
                
                    echo "</pre>";
                }
            }
            else{ 
            die ("Klaida įrašant:" . $conn->error); 
            }

            echo "<form action='isimtivisasarasa.php' method='post'>
            <input type='hidden' name='prekes_id' value=''>
            <input type='submit' value='Atšaukti'>
        </form>";
        echo "<br>";
        echo "<form action='pirk.php' method='post'>
        <input type='hidden' name='prekes_id' value=''>
        <input type='submit' value='PERKU!'>
    </form>";


?>
                                </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>
    <?php
    ?>