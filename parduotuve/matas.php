<?php
session_start();
include("include/nustatymai.php");
include("include/functions.php");
?>
<html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Naudotojas</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
                    <table class="center"><tr><td><img src="include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="naudotojai.php">Naudotojus</a>]</td></tr>
				    </table>   <br>
								<div align="center" style="background-color: aqua; padding: 10px;>
                    			<table> <tr><td>           
                                <center style="font-size:18pt;"><b>Naudotojas</b></center>
				                    <p style="text-align:left;">Vardas: Matas</p>
				                    <p style="text-align:left;">Pavardė: Mataitis</p>
									<p style="text-align:left;">El. paštas: matas@gmail.com<br></p>
                                    <p style="text-align:left;">Slaptažodis: verlis123<br></p>
                                    <p style="text-align:left;">Ar blokuotas: Taip<br></p>
                                    <button onclick="window.location.href='redaguotimatas.php'">
					                    Redaguoti
    			                    </button>
                                    </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>