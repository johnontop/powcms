<?php
ini_set('display_errors', '1'); 
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