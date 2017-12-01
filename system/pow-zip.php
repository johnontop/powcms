<?php



function zipsub($zipfiles){

// increase script timeout value
ini_set("max_execution_time", 600);
ini_set('memory_limit','1024M');

$files = glob('./*.zip'); //get all file names
foreach($files as $file){
    if(is_file($file))
    unlink($file); //delete file
}

$root = $_COOKIE['root']; 
$stop = basename(__DIR__) ;

if($stop == basename($root)) { 
echo 'You can not zip the root folder: ' . basename($root) ;
exit;
}


if($zipfiles==1) {
echo 'Creating zip file: '. basename(__DIR__); //will return the current directory name only
$zipname = basename(__DIR__); //will return the current directory name only
$dir ="./";
$zip = new ZipArchive;
if ($zip->open($zipname.'.zip', ZipArchive::OVERWRITE) === TRUE)
{
    if ($handle = opendir($dir))
    {
        // Add all files inside the directory
        while (false !== ($entry = readdir($handle)))
        {
            if ($entry != "." && $entry != ".." && !is_dir($dir . $entry))
            {
                rename($dir.'index_vars.js', $dir.'index_vars.txt'); // renames incoming index_vars.txt in zip
                $zip->addFile($dir . $entry);
            }
        }
        closedir($handle);
    }
 
    $zip->close();
}
} // end $zipfiles 1


// ZIP ALL FOLDERS

if($zipfiles==2) {
$no_zip = array('G:\powcms\pages\page-1', 'page-2');
$zipname = basename(__DIR__); //will return the current directory name only
$path = realpath(__DIR__);
echo "<br>Zipping " . $path. "<br />";
$zip = new ZipArchive();
$zip->open($zipname.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($files as $name => $file)
{
	if ($file->isDir()) {
	
	  if(!in_array($file, $no_zip)) {
	 	
  	     rename($file.'/index_vars.js', $file.'/index_vars.txt'); // renames index_vars.js to index_vars.txt in zip
         		   
         if(basename(dirname(__FILE__))=='pages' ){echo '<b style="margin-left: 0px;">Skip powcms </b>';}
          echo $file . "<br>";
      flush();           
		  continue;
		}
	}
	
	$filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($path) + 1);	            
    $zip->addFile($filePath, $relativePath);
}
$zip->close();
echo "Created zip file: ". $zipname.'.zip';

} // end $zipfiles 2
} // end zipsub

zipsub(2);
    
  ?>