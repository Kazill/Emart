<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
?>
<html>
<script>
function confirmAction(linkUrl, actionName) {
    var confirmed = confirm('Ar tikrai norite ' + actionName.toLowerCase() + '?');
    if (confirmed) {
        // If the user clicked OK, redirect to the linkUrl
        window.location.href = linkUrl;
    }
    // If the user clicked Cancel, do nothing
}
</script>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Prekė</title>
            <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
                    <table class="center"><tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/perziureti_prekiu_sarasa.php">Prekių sąrašą</a>]</td></tr>
				    </table>   <br>
								<div align="center" style="background-color: aqua; padding: 10px;">        
                                <center style="font-size:18pt;"><b>Prekė</b></center>
                                    <img src="img_preke.jpg" alt="Prekės nuotrauka" width="500" height="600"> 
				                    <p style="text-align:left;">Pavadinimas: Ekranas</p>
				                    <p style="text-align:left;">Pardavėjas: Antanas</p>
									<p style="text-align:left;">Kaina: 100.99<br></p>
                                    <p style="text-align:left;">Kiekis: 15<br></p>
                                    <p style="text-align:left;">Gamintojas: Gamintojas<br></p>
                                    <p>Funkcijos tokios pačios kaip ir su preke "Laidas"</p>
                                    </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>