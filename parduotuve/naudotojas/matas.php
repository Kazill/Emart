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
            <title>Naudotojas</title>
            <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
                    <table class="center"><tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]</td></tr>
				    </table>   <br>
								<div align="center" style="background-color: aqua; padding: 10px;">        
                                <center style="font-size:18pt;"><b>Naudotojas</b></center>
				                    <p style="text-align:left;">Vardas: Matas</p>
				                    <p style="text-align:left;">Pavardė: Mataitis</p>
									<p style="text-align:left;">El. paštas: matas@gmail.com<br></p>
                                    <p style="text-align:left;">Slaptažodis: verlis123<br></p>
                                    <p style="text-align:left;">Ar blokuotas: Taip<br></p>
                                    <button onclick="window.location.href='/Emart/parduotuve/naudotojas/redaguotitomas.php'">
					                    Redaguoti
    			                    </button>
                                    <button onclick="window.location.href='/Emart/parduotuve/naudotojas/pranesimas.php'">
					                    Pranešimas
    			                    </button>
                                    <button onclick="window.location.href='/Emart/parduotuve/naudotojas/apeliacija.php'">
					                    Apeliacija
    			                    </button>
                                    <button onclick="confirmAction('/Emart/parduotuve/naudotojas/naudotojai.php', 'Blokuoti');">
                                        Blokuoti
                                    </button>
                                    <button onclick="confirmAction('/Emart/parduotuve/naudotojas/naudotojai.php', 'Pašalinti');">
                                        Pašalinti
                                    </button>
                                    </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>