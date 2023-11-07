<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/nustatymai.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
?>
<html>
<script>
function showConfirmDialog(removeId) {
	var r = confirm("Ar tikrai norite pašalinti!");
	if (r === true) {
		window.location.replace("perziureti_prekiu_sarasa.php");
		}
};
function openPopup() {
    var popup = document.getElementById("popupContainer");
    var content = document.getElementById("checkBundle");
    popup.style.display = "block";
    content.style.display = "block";
        }

        function closePopup() {
        var popup = document.getElementById("popupContainer");
        var content = document.getElementById("checkBundle");
        popup.style.display = "none";
        content.style.display = "none";
        }

</script>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Prekė</title>
            <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
            <style>
                /* Styles for the popup container */
.popup-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

/* Styles for the popup content */
.popup-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 2px 5px #000;
    z-index: 2;
}

/* Styles for the close button */
.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}

            </style>
        </head>
        <body>   
                    <table class="center"><tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="/Emart/parduotuve/prekiu_posisteme/perziureti_prekiu_sarasa.php">Prekių sąrašą</a>]</td></tr>
				    </table>   <br>
								<div align="center" style="background-color: aqua; padding: 10px;">        
                                <center style="font-size:18pt;"><b>Prekė</b></center>
                                    <img src="img_preke.jpg" alt="Prekės nuotrauka" width="500" height="600"> 
				                    <p style="text-align:left;">Pavadinimas: Laidas</p>
				                    <p style="text-align:left;">Pardavėjas: Petras</p>
									<p style="text-align:left;">Kaina: 10.20<br></p>
                                    <p style="text-align:left;">Kiekis: 150<br></p>
                                    <p style="text-align:left;">Gamintojas: Gamintojas<br></p>
                                    <button onclick="window.location.href='/Emart/parduotuve/krepselis.php'">
					                    Įdėti į krepšelį
    			                    </button>
                                    <br><br>
                                    <input type="button" id="popupbutton" onclick="openPopup()" value="Priskirti kategoriją"/>

<!-- The popup container with the content -->
<div id="popupContainer" class="popup-container">
    <div id="checkBundle" class="popup-content" style="display: none;">
        <span class="close-button" onclick="closePopup()">&times;</span>
        <h2>Kategorijos</h2>
        <ul>
            <li><label><input type="checkbox" />A</label></li>
            <li><label><input type="checkbox" />B</label></li>
            <li><label><input type="checkbox" />C</label></li>
            <li><label><input type="checkbox" />D</label></li>
        </ul>
        <input type="button" id="close" onclick="closePopup()" value="Išsaugoti"/>
    </div>
</div>

                                    <button onclick="window.location.href='/Emart/parduotuve/prekiu_posisteme/redaguoti_preke.php'">
					                    Redaguoti
    			                    </button>

                                    <button onclick=showConfirmDialog(null)>
					                    Pašalinti prekę
    			                    </button>
                                    </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>