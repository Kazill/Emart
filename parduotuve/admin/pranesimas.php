<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
session_start();
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/functions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/Emart/parduotuve/include/db_connect.php");
$_SESSION['prev']="zinutes";
?>
<head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Pranešimas</title>
            <link href="/Emart/parduotuve/include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
<?php
	$siuntejas = $_SESSION['userId'];
    $gavejas = $_GET['email'];

    if($_POST !=null){
	    $header =$_POST['priezastis'];
	    $text =$_POST['tekstas'];
	    $sql = "INSERT INTO pranesimai (gavejas, fk_Administratoriusid_Administratorius, data, tekstas, priezastis) VALUES ('$gavejas', '$siuntejas', now(), '$text', '$header')";
	    if (!mysqli_query($conn, $sql))  $_SESSION['message']="Klaida įrašant:" .mysqli_error($dbc);	
        $text = wordwrap($text,70);
        try{
            $mail=mail($gavejas,$header,$text);
            echo $mail;
            $_SESSION['message']=$mail."Išsiųstas pranešimas";
        }
        catch(Exception $e){
            $_SESSION['message']="Klaida siunčiant:" . $e;
        }
        header('Location: /Emart/parduotuve/naudotojas/naudotojai.php');
        exit();
    }
?>
                    <table class="center"><tr><td><img src="/Emart/parduotuve/include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="/Emart/parduotuve/naudotojas/naudotojai.php">Naudotojus</a>]</td></tr>
				    </table>   <br> 
                    <?php
                        echo "<center style='color: red'>".$_SESSION['message']."</center>";
                        $_SESSION['message']='';
                     ?>
                                    <div style="background-color: aqua; padding: 10px;">
                                    <center><b>Pranešimas</b></center>
                                    <div align="center" style="background-color: aqua; padding: 10px;">
                <form method="post">
                    <p style="text-align:left;">Priežastis:<br>
                        <input type="text" name="priezastis"></p>
                        <p style="text-align:left;">Tekstas:<br>
                        <textarea name="tekstas" rows="4" cols="50"></textarea>
                        </p>

                        <center><input type='submit' name='ok' value='Siųsti' class="btnbtn-default"></center>
                    </p>
                </form>
            </div>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
</html>