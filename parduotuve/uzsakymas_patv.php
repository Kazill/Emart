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
        </head>
        <body>   
                    <table class="center"><tr><td><img src="include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="uzsakymai.php">Užsąkymus</a>]</td></tr>
				    </table>   <br>
								<div align="center" style="background-color: aqua; padding: 10px;>
                    			<table> <tr><td>           
                                <center style="font-size:18pt;"><b>Užsąkymas</b></center>
                                <p style="text-align:left;">Id: 5<br></p>
                                <p style="text-align:left;">Pirkėjas: Tomas<br></p>
                                <p style="text-align:left;">Pardavėjas: Matas<br></p>
									<p style="text-align:left;">Data: 2023-04-11<br></p>
                                    <p style="text-align:left;">Užsąkymo kaina: 100.25<br></p>
                                    <p style="text-align:left;">Būsena: Nepatvirtintas<br></p>
                                    <p style="text-align:left;">Pristatymo būdas: paštu<br></p>
                                    </td></tr>
                                <tr><button onclick="window.location.href='uzsakymas.php'">
					            Patvirtinti
    			                </button></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>