<?php
//nustatymai.php
define("DB_SERVER", "158.129.26.35");
define("DB_USER", "root");
define("DB_PASS", "313kambarys313");
define("DB_NAME", "isp");

//define("DB_SERVER", "localhost");
//define("DB_USER", "stud");
//define("DB_PASS", "stud");
//define("DB_NAME", "vartvald");

define("TBL_USERS", "Naudotojas");
define("TBL_ADRESS", "Adresas");
//define("TBL_ITEMS", "prekes");

$user_roles=array(      // vartotojų rolių vardai lentelėse ir  atitinkamos userlevel reikšmės
	"Administratorius"=>"1",
	"Darbuotojas"=>"2",
	"Klientas"=>"3",);   // galioja ir vartotojas "guest", kuris neturi userlevel
define("DEFAULT_LEVEL","Klientas");  // kokia rolė priskiriama kai registruojasi
define("ADMIN_LEVEL","Administratorius");  // kas turi vartotojų valdymo teisę
define("UZBLOKUOTAS","255");      // vartotojas negali prisijungti kol administratorius nepakeis rolės
$uregister="both";  // kaip registruojami vartotojai
// self - pats registruojasi, admin - tik ADMIN_LEVEL, both - abu atvejai
// * Email Constants - 
define("EMAIL_FROM_NAME", "Demo");
define("EMAIL_FROM_ADDR", "demo@ktu.lt");
define("EMAIL_WELCOME", false);
