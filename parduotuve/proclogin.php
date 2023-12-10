<?php
session_start(); 
  include("include/nustatymai.php");
  include("include/functions.php");
  $_SESSION['prev'] = "proclogin";
  $_SESSION['mail_error']="";
  $_SESSION['pass_error']="";
  $_SESSION['message']="";
  $_SESSION['email']="email@gmail.com";
  $_SESSION['userId']="2";
  header("Location:index.php?");exit;
?>