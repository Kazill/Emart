<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// register.php registracijos forma
// jei pats registruojasi rolė = DEFAULT_LEVEL, jei registruoja ADMIN_LEVEL vartotojas, rolę parenka
// Kaip atsiranda vartotojas: nustatymuose $uregister=
//                                         self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai galimi
// formos laukus tikrins procregister.php

session_start();
if (empty($_SESSION['prev'])) { header("Location: logout.php");exit;} // registracija galima kai nera userio arba adminas
// kitaip kai sesija expirinasi blogai, laikykim, kad prev vistik visada nustatoma
include_once("include/nustatymai.php");
include_once("include/functions.php");

if ($_SESSION['prev'] != "procregister")  inisession("part");  // pradinis bandymas registruoti

$_SESSION['prev']="register";
?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"> 
            <title>Registracija</title>
            <link href="include/styles.css" rel="stylesheet" type="text/css" >
        </head>
        <body>   
                    <table class="center"><tr><td><img src="include/top.png"></td></tr><tr><td> 
                        <table style="border-width: 2px; border-style: dotted;"><tr><td>
                           Atgal į [<a href="index.php">Pradžia</a>]</td></tr>
				    </table>   
								<div align="center">
                    			<table> <tr><td>
								<form action="procregister.php" method="POST" class="login">
                                                <center style="font-size:18pt;"><b>Registracija</b></center>
										
									<p style="text-align:left;">Vardas:<br>
            						<input class ="s1" name="vardas" type="text" value="<?php echo $_SESSION['name_login'];  ?>"><br>
           							<?php echo $_SESSION['name_error']; ?>
        							</p>
									<p style="text-align:left;">Pavardė:<br>
            						<input class ="s1" name="pavarde" type="text" value="<?php echo $_SESSION['pavarde_login'];  ?>"><br>
           							<?php echo $_SESSION['pavarde_error']; ?>
        							</p>
									<p style="text-align:left;">Gimimo data:<br>
            						<input class ="s1" name="data" type="date" value="<?php echo $_SESSION['data_login'];  ?>"><br>
           							<?php echo $_SESSION['data_error']; ?>
        							</p>
									<p style="text-align:left;">Tel. Nr.:<br>
            						<input class ="s1" name="tel" type="text" value="<?php echo $_SESSION['tel_login'];  ?>"><br>
           							<?php echo $_SESSION['tel_error']; ?>
        							</p>
       								<p style="text-align:left;">Slaptažodis:<br>
          							<input class ="s1" name="pass" type="password" value="<?php echo $_SESSION['pass_login']; ?>"><br>
            						<?php echo $_SESSION['pass_error']; ?>
        							</p>  
									<p style="text-align:left;">E-paštas:<br>
                                    <input class ="s1" name="email" type="text" value="<?php echo $_SESSION['mail_login']; ?>"><br>
									<?php echo $_SESSION['mail_error']; ?>
                                    </p>  
									<?php
										 if ($_SESSION['tipas'] == $user_roles[ADMIN_LEVEL] )
										{echo "<p style=\"text-align:left;\">Rolė<br>";
										 echo "<select name=\"role\">";
   									   	 foreach($user_roles as $x=>$x_value)
  											{echo "<option ";
        	 									if ($x == DEFAULT_LEVEL) echo "selected ";
             									echo "value=\"".$x_value."\" ";
         	 									echo ">".$x."</option></p>";
											}
										}
									?>
                      	
                                    <p style="text-align:left;">
                                    <input type="submit" value="Registruoti">
                                    </p>
                                    </form>
                                    </td></tr>
			                    </table>
                             </div>
                </td></tr>
                </table>           
        </body>
    </html>
   
