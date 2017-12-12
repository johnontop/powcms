<?php
ini_set('display_errors', '0'); 

$root = $_COOKIE['root']; 
if (empty($root)){$root = basename(__DIR__) ; } else {$root = $_COOKIE['root'];}

/* COOKIE LOGIN CHECK - for valid username and passwords - Change password in /pow-config.php*/
include 'pow-config.php' ;

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    
    if (($_COOKIE['username'] = $user) || ($_COOKIE['password'] = sha1($pass))) {            
        // echo 'Welcome back ' . $_COOKIE['username'];
    } else {        
        header('Location: pow-login.php');
        exit;
    }    
  } else {
    header('Location: pow-login.php');   
    exit; 
  } // END COOKIE LOGIN CHECK


if (isset($_GET['action'])){  
  if (version_compare(phpversion(), "5.4.9", "=")) {
  echo "PHP version is 5.4.9 - offline features allowed" ;
  //header('Location: ./pow-scan.php');
  $updatefiles = "CopyFiles.bat";
  exec("start /MIN $updatefiles");
  echo "Finished";
  header('Location: ./pow-scan.php');
exit; 

} else {
  echo "PHP version is not 5.4.9 - for security reasons, some functions does not work online." ;
  ?>
<script>
  alert("PHP version is not 5.4.9 - for security reasons, some functions does not work online.");  
</script>  
<?php  
}

} else {
exit;  
}

?>