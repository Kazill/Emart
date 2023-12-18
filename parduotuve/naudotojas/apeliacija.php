<?php
session_start();
?>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
    <title>Apeliacija</title>
    <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css">
</head>

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
                            Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]</td>
                    </tr>
                </table> <br>
                <div style="background-color: aqua; padding: 10px;">
                    <center><b>Apeliacija</b></center>
                    <div align="center" style="background-color: aqua; padding: 10px;">
                        <form action="/Emart/parduotuve/naudotojas/naudotojai.php" method="post">
                            <p style="text-align:left;">Priežastis:<br>
                                <input type="text" name="Priežastis" value="Pardavinėja broką" />
                            </p>
                            <p style="text-align:left;">Tekstas:<br>
                                <textarea name="Tekstas" rows="4" cols="50">Nusipirkau rašiklį ir kai jį gavau jis buvo be rašalo.</textarea>
                            </p>

                            <button type="submit">Siųsti apeliaciją</button>
                            </p>
                        </form>
                    </div>
            </td>
        </tr>
    </table>
    </div>
    </td>
    </tr>
    </table>
</body>

</html>