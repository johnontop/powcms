<?php
ini_set('display_errors', '0');

 /* Intended to be run by start.bat file when multiple POWCMS on the same PC are used */
  setcookie("username", '',time() - 3600);
  setcookie("password", '',time() - 3600);
  setcookie("root", '',time() - 3600);
  setcookie('login_status','Logged Out', time()+60*60*24*365 );
  header('Location: start.htm');  
?>
