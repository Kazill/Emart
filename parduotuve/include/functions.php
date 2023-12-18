<?php
// funkcijos  include/functions.php

function inisession($arg) {   //valom sesijos kintamuosius
            if($arg =="full"){
                $_SESSION['message']="";
                $_SESSION['email']="";
                $_SESSION['vardas']="";
                $_SESSION['pavarde']="";
                $_SESSION['data']="";
                $_SESSION['tel']="";
                $_SESSION['tipas']=0;
                $_SESSION['adresoid']=0;
            }			    	 
		$_SESSION['name_login']="";
		$_SESSION['pavarde_login']="";
		$_SESSION['pass_login']="";
		$_SESSION['passn_login']="";
		$_SESSION['mail_login']="";
		$_SESSION['data_login']="";
		$_SESSION['tel_login']="";
		$_SESSION['role_login']="";
	
		$_SESSION['name_error']="";
		$_SESSION['pavarde_error']="";
      	$_SESSION['pass_error']="";
		$_SESSION['mail_error']=""; 
		$_SESSION['data_error']="";
		$_SESSION['tel_error']="";
		$_SESSION['role_error']="";
        }

function checkname ($username){   // Vartotojo vardo sintakse
	   if (!$username || strlen($username = trim($username)) == 0) 
			{$_SESSION['name_error']=
				 "<font size=\"2\" color=\"#ff0000\">* Neįvestas vartotojo vardas</font>";
			 "";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $username))  /* Check if username is not alphanumeric */ 
			{$_SESSION['name_error']=
				"<font size=\"2\" color=\"#ff0000\">* Vartotojo vardas gali būti sudarytas<br>
				&nbsp;&nbsp;tik iš raidžių ir skaičių</font>";
		     return false;}
	        else return true;
   }
             
 function checkpass($pwd,$dbpwd) {     //  slaptazodzio tikrinimas (tik demo: min 4 raides ir/ar skaiciai) ir ar sutampa su DB esanciu
	   if (!$pwd || strlen($pwd = trim($pwd)) == 0) 
			{$_SESSION['pass_error']=
			  "<font size=\"2\" color=\"#ff0000\">* Neįvestas slaptažodis</font>";
			 return false;}
            elseif (!preg_match("/^([0-9a-zA-Z])*$/", $pwd))  /* Check if $pass is not alphanumeric */ 
			{$_SESSION['pass_error']="* Čia slaptažodis gali būti sudarytas<br>&nbsp;&nbsp;tik iš raidžių ir skaičių";
		     return false;}
            elseif (strlen($pwd)<4)  // per trumpas
			         {$_SESSION['pass_error']=
						  "<font size=\"2\" color=\"#ff0000\">* Slaptažodžio ilgis <4 simbolius</font>";
		              return false;}
	          elseif ($dbpwd != substr(hash( 'sha256', $pwd ),5,32))
               {
				  	$_SESSION['pass_error']="<font size=\"2\" color=\"#ff0000\">* Neteisingas slaptažodis</font>";
				  
					return false;
			  }
            else {
				
				return true;
			}
   }
   function checkPasswordStrength($password) {
    // Set a minimum length for the password
    $minLength = 8;

    // Regular expression to check if the password includes:
    // at least one digit (?=.*\d)
    // at least one lowercase character (?=.*[a-z])
    // at least one uppercase character (?=.*[A-Z])
    // at least one special character (?=.*\W)
    // and is at least $minLength characters long .{$minLength,}
    $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{' . $minLength . ',}$/';

    // Check the strength of the password against the pattern
    if (preg_match($pattern, $password)) {
        return true; // The password is strong
    } else {
        $_SESSION['pass_error'] = "<font size=\"2\" color=\"#ff0000\">* Slaptažodis nėra pakankamai stiprus. Jis turi būti mažiausiai 8 simbolių ilgio ir turėti mažąsias ir didžiąsias raides, skaičius bei specialiuosius simbolius.</font>";
        return false; // The password is not strong enough
    }
}

 function checkdb($mail) {  // iesko DB pagal varda, grazina {vardas,slaptazodis,lygis,id} ir nustato name_error
		 $db=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		 $sql = "SELECT * FROM " . TBL_USERS. " WHERE el_pastas = '$mail'";
		 $result = mysqli_query($db, $sql);
	     $umail = $uvardas = $upavarde = $udata = $upass = $utel = $utipas = $adresoid = null;
		 if (!$result || (mysqli_num_rows($result) != 1))   // jei >1 tai DB vardas kartojasi, netikrinu, imu pirma
	  	 {  // neradom vartotojo DB
		    $_SESSION['name_error']=
			 "<font size=\"2\" color=\"#ff0000\">* Tokio vartotojo nėra</font>";
         }
      else {  //vardas yra DB
          $row = mysqli_fetch_assoc($result);
		  $umail = $row["el_pastas"];} 
          $uvardas= $row["vardas"]; 
          $upavarde= $row["pavarde"]; 
          $udata= $row["gimimo_data"];
		  $upass= $row["slaptazodis"]; 
          $utel=$row["tel_nr"]; 
		  $utipas= $row["tipas"]; 
		  $adresoid= $row["fk_Adresasid"]; 
	 
     return array($umail,$uvardas,$upavarde,$udata,$upass,$utel,$utipas,$adresoid);
 }

function checkmail($mail) {   // e-mail sintax error checking  
	   if (!$mail || strlen($mail = trim($mail)) == 0) 
			{$_SESSION['mail_error']=
				"<font size=\"2\" color=\"#ff0000\">* Neįvestas e-pašto adresas</font>";
			   return false;}
            elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
			      {$_SESSION['mail_error']=
					   "<font size=\"2\" color=\"#ff0000\">* Neteisingas e-pašto adreso formatas</font>";
		            return false;}
	        else return true;
   }
