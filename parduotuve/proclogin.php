<?php
session_start(); 
  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['prev'] = "proclogin";
  $_SESSION['mail_error']="";
  $_SESSION['pass_error']="";
  $_SESSION['email']="email@gmail.com";
  header("Location:index.php?");exit;
?>