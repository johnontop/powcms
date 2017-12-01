<?php

if (isset($_GET['action'])){ 
  echo "GET is set - continue.<br />";
}  else {
  echo "GET is sett to - files!<br />";
  header('Location: ./pow-scan.php');
  $updatefiles = "CopyFiles.bat";
  exec("start /MIN $updatefiles");
  echo "Finished";
  //header('Location: ./pow-scan.php');
exit;  
}


if (isset($_GET['action']) == 'ftp') {
header('Location: ./pow-scan.php');
}

?>