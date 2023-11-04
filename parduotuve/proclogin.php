<?php
// proclogin.php tikrina prisijungimo reikšmes
// formoje įvestas reikšmes išsaugo $_SESSION['xxxx_login']
// jei randa klaidų jas sužymi $_SESSION['xxxx_error']
// jei vardas ir slaptažodis tinka, užpildo $_SESSION['user'] ir $_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']  atžymi prisijungimo laiką DB
// po sėkmingo arba ne bandymo jungtis vėl nukreipia i index.php
//
// jei paspausta "Pamiršote slaptažodį", formoje turi būti jau įvestas vardas , nukreips į forgotpass.php, o ten pabars ir į newpass.php
session_start(); 
// cia sesijos kontrole: proclogin tik is login  :palikti taip
  // if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "login"))
	// { header("Location: logout.php");exit;}
  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['prev'] = "proclogin";
  $_SESSION['mail_error']="";
  $_SESSION['pass_error']="";
  $_SESSION['email']="email@gmail.com";
 
  // $email=strtolower($_POST['email']);   // i mazasias raides
  // $_SESSION['mail_login']=$email;

// // pasiruosiam klaidoms is anksto
//   if (isset($_POST['problem'])) {  // nori pagalbos
// 	 $_SESSION['message']="Turi būti įvestas galiojantis el. pašto adresas";}  
//   else {}
            
//         if (checkmail($email)) //vardo sintakse
//         { list($umail,$uvardas,$upavarde,$udata,$upass,$utel,$utipas,$adresoid)=checkdb($email);  //patikrinam ir jei randam, nuskaitom DB   
//          if ($umail)  {  //yra vartotojas DB
           
// 		   $_SESSION['tipas']=$utipas; 
//        $_SESSION['email']=$umail; 
           
//            // $_SESSION['user'] - nustatysim veliau, jei slaptazodis  geras
// 		   if (isset($_POST['problem'])){  // vartotojas praso priminti slaptazodi
//                               header("Location:forgotpass.php");exit;
//                         }
// 		  	$pass=$_POST['pass'];$_SESSION['pass_login']=$pass;
           
//           	if (checkpass($pass,$upass))
// 	       	{ // vardas ir slaptazodis geras 
// 			   if ($utipas == UZBLOKUOTAS) 
// 			      {$_SESSION['message']="Jūsų paskyra užblokuota";
// 				   $_SESSION['name_error']=
// 				     "<font size=\"2\" color=\"#ff0000\">* Prisijungimas negalimas. Kreipkitės į administratorių</font>";
// 				  }
// 				else {
// 					// ar level galiojantis?
          
// 				$yra=false;
// 				foreach($user_roles as $x=>$x_value){
//           if ($x_value == $utipas) {
//             $yra=true;
//           }	 
//         }
          
// 				if (!$yra)
// 				{$_SESSION['message']="Negaliojanti vartotojo rolė.";
// 				 $_SESSION['name_error']=
// 				     "<font size=\"2\" color=\"#ff0000\">* Prisijungimas negalimas. Kreipkitės į administratorių</font>";}
// 			 	else{
// 			  //prijungiam
			  
//         $_SESSION['email']=$email;
// 			  $_SESSION['prev']="proclogin";
//         $_SESSION['message']="";
          
//              }}
//            }
//     }}

  //           session_regenerate_id(true);
            header("Location:index.php?");exit;
            ?>