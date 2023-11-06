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
								<div align="center" style="background-color: aqua; padding: 10px;>
                    			<table> <tr><td>           
                                <center style="font-size:18pt;"><b>Užsąkymas</b></center>
                                <p style="text-align:left;">Prekės:<br></p>
<pre style="text-align:left;">
<b>Pavadinimas 	        Kaina		        Kiekis		        Suma</b>
Laidas			10.20			2			20.40
Ekranas			100.99			1			100.99
Plančetė		500.55			1			500.55
</pre>
                                <p style="text-align:left;">Užsąkymo kaina: 621.94<br></p>
                                <p style="text-align:left;"><label style="text-align:left;">Pristatymo būdas:</lable>
                                <input type="text" name="pristatymas" value="" ><br></p>
                                <p style="text-align:left;">
                                    <button onclick=showConfirmDialogBuy()>Pirkti</button>
                                    <button onclick=showConfirmDialogCancel()>Atšaukti</button>
                                </p>
                                </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>