
<?php
ini_set('display_errors', '0');
/**
 * Scans a directory recursively
 * Can filter the directory to show only desired file extensions
 *
 * @author Jeremy Simkins <SoN9ne> + John Bowman
 * http://snipplr.com/view/46276/phphtmlcss--script-to-scan-a-directoy-recursively-with-filters-andor-ingore-list/ 
 * https://snippets.pw/23194-phphtmlcss-script-to-scan-a-directoy-recursively-with-filters-andor-ingore-list 
 */

/**
 * Prepare filters
 * - Do not edit unless you know what you are doing!
 * - Look below (Look for BEGIN) to edit the filters
 */
# Define search Filters
$searchFilter = array();
$searchFilter['file'] = array();
$searchFilter['extension'] = array();
$searchFilter['directory'] = array();

# Define ignore Filters
$ignore = array();
$ignore['file'] = array();
$ignore['extension'] = array();
$ignore['directory'] = array();
//--> End Prepare filters


//-----[ BEGIN - Edit this data as you see fit ]-----------------------------------\\
/**
 * Directory to scan
 * @var string 
 */
$directory = "./"; // up one directory to get all the files of the system


/**
 * Set the maximum depth for the scan
 * 
 * @var mixed - NULL|int - NULL will have no depth limitation, int is the number of levels deep to step into
 */
define('MAX_SCAN_DEPTH', NULL);

/**
 * Custom search filters
 * 	- You can add any type of filter to limit the search.
 * 
 * Notes:
 * - Extension and directory filters should be all lowercase
 * - File filters should include the extension and are case-sensitive
 */
# Define search extension filters
//$searchFilter['extension'][] = 'php';


# Define search file filters
//$searchFilter['file'][] = 'info.htm';
//$searchFilter['file'][] = '';


# Define search directory filters
$searchFilter['directory'][] = '.\system';
$searchFilter['directory'][] = '.\system\login';
//--> End search filters


/**
 * Edit the ignore filters
 */
# Define ignore extension filters

# Define ignore file filters
//$ignore['file'][] = '';
$ignore['file'][] = 'info-htm';
$ignore['file'][] = 'side-pages.htm';
$ignore['file'][] = 'side-links.htm';

$ignore['extension'][] = 'js'; // JS file
$ignore['extension'][] = 'php'; // PHP file
$ignore['extension'][] = 'bat'; // BAT file
$ignore['extension'][] = 'exe'; // EXE file
$ignore['extension'][] = 'dll'; // DLL file
$ignore['extension'][] = 'doc'; // DLL file

$ignore['extension'][] = 'conf'; // EXE file
$ignore['extension'][] = 'frm'; // MySQL file
$ignore['extension'][] = 'myd'; // MySQL file
$ignore['extension'][] = 'myi'; // MySQL file
$ignore['extension'][] = 'xml'; // MySQL file
$ignore['extension'][] = 'project'; // ZDE file

# Define ignore directory filters
$ignore['directory'][] = '.system'; // Do not scan system directories
$ignore['directory'][] = '.system/php'; // Do not scan system directories
$ignore['directory'][] = '.system/php/ext'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL/udrive'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL/udrive/bin'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL/udrive/data'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL/udrive/data/mysql'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL'; // Do not scan system directories
$ignore['directory'][] = '.system/MySQL'; // Do not scan system directories
$ignore['directory'][] = '.res/'; // Do not scan RES .setting folder
$ignore['directory'][] = '.res/tinymce'; // Do not scan RES .setting folder
$ignore['directory'][] = 'res\tinymce\plugins'; // Do not scan RES .setting folder
$ignore['directory'][] = '__sessions'; // Do not scan custom sessions storage folder
//--> End ignore filters
//-----[ STOP - Edit this data as you see fit ]-----------------------------------\\


/**
 * Do Not edit below unless you know what you are doing
 */
# Set timezone
date_default_timezone_set('America/New_York');

# Total files flag
$totalFiles = 0;
$totalDirectories = 0;

# Define direcoty tree array
$directory_tree = array();

# Scan the directory
$directory_tree = customScanDir($directory, $searchFilter, $ignore);

# Sort the array
array_sort($directory_tree, 'name');

//echo '<pre>';
//print_r($directory_tree);
//echo '</pre>';
//die();


# Start output buffering
ob_start();  

fopen("search_content.js", "w") or die("Unable to open file!");
fwrite("search_content.js", pack("CCC",0xef,0xbb,0xbf)); 
file_put_contents("search_content.js", "var tipuesearch = {'pages': [". PHP_EOL, FILE_APPEND);
//echo '<font color="red"> Creating Search File</font>'; 

fopen("search_tags.tmp", "w") or die("Unable to open file!");
fwrite("search_tags.tmp", pack("CCC",0xef,0xbb,0xbf)); 

# Display the content
displayDirRecursively($directory_tree, $totalFiles, $totalDirectories, $search_file);


# Save output to a var
$tmp = ob_get_contents();

# Delete the output buffer
ob_end_clean();

# Output the page
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>File Scanner</title>
   
  <!-- Bootstrap -->
<?php if(file_exists($root.'res/bootstrap/bootstrap.min.css')) { ;?>  
   <link href="/res/bootstrap/bootstrap.min.css" rel="stylesheet">  
  <?php } else { ;?> 
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php } ;?>   
   
  <!-- Custom Fonts -->          
<?php if(file_exists($root.'res/font-awesome/css/font-awesome.min.css')) { ;?>  
    <link href="/res/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">  
  <?php } else { ;?> 
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<?php } ;?>

<?php if(file_exists($root.'res/font-roboto/roboto.css')) { ;?>  
    <link href="/res/font-roboto/roboto.css" rel="stylesheet">   
  <?php } else { ;?> 
    <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
<?php } ;?>  

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins and reading files via index_vars.js) -->    
<?php if(file_exists($root.'res/js/jquery.min.js')) { ;?>  
    <script src="/res/js/jquery.min.js"></script>
  <?php } else { ;?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php } ;?>    
  
    <!-- Custom styles for index.htm wrapper page -->
    <link href="/theme/default.css" rel="stylesheet">
    <link href="/theme/custom.css" rel="stylesheet"> 
    <link href="/system/edit-mode.css" rel="stylesheet">
        
<style>
body {
	margin: 0;
	margin-top: 60px;
	padding: 0;
	font: normal 14px Arial;
	color: #666;
	background: #fafafa ;
}

.page-bg {
  background-color: #fff ;  
  border: 1px solid;
  border-color: #ddd;
  min-height:1080px;
}

.dirList ul,ol {
	background: #fff;
	border: 4px solid #fff;
	
}

.dirList {
	margin: 15px auto;
	width: 80%;
	overflow: hidden;
	-moz-box-shadow: 0 0 20px #b5b5b5;
  padding-right: 30px;	
}

#detail-container {
	margin: 5px auto;
	/* width: 63.5%; */
	width: 1060px;
}

#details,#legend,#files,#search {
	margin: 5px auto;
	-moz-box-shadow: 0 0 20px #b5b5b5;
}

#details {
	float: left;
	width: 33%;
	list-style: none;
}

#legend {
	display: inline-block;
	float: right;
	width: 18%;
}

#search {
	display: inline-block;
	float: right;
	width: 22%;
	margin-right:20px;
	list-style: none;
}

#files {
	display: inline-block;
	float: right;
	width: 18%;
	margin-right:20px;
}

.clear {
	clear: both;
}

.dirList li {
	line-height: 1.8em;
	margin: 0 5px;
	padding-left: 2em;
	text-indent: -2em;
	width: 100%;	
}

ol.legend:first-child {
	background: maroon;   
}

.dirList li:nth-child(even) {
	background: #fff;     
}

.dirList li:nth-child(odd) {
	background: #ecf3fe;  
}

.dirList li:hover {
	background: yellow;    
}

.dirList ul {
	margin-left: -60px;
}

#details .title,#legend .title,#files .title,#search .title {
	list-style: none;
	font-weight: bold;
	border-bottom: 1px solid #ccc;
	margin: 0 0 0 -38px;
}

.folder {
	list-style: circle;
}

.file {
	list-style: square;
	
}

h3,h4 {
	padding: 10px;
	margin: 0px;
	font: normal 20px 'Trebuchet MS';
	text-align: center;
}

h4 {
	font: normal 15px 'Trebuchet MS';
}

.dirList a {
	color: #0079e0;
	text-decoration:none;
}

.dirList a:visited {
	color: purple;
}
.button a
{
	border-top:	1px solid #a3ceda;
	border-left:	1px solid #a3ceda;
	border-right:	1px solid #4f6267;
	border-bottom: 1px solid #4f6267;
	padding:		2px 7px !important;
	font-size:		12px !important;
	background-color:	#fafafa;
	font-weight:	normal;
	color: #111;
	border-radius:2px;
	text-decoration:none;
}

.button {     /* https://catalin.red/just-another-awesome-css3-buttons/ */   
    display: inline-block;
    white-space: nowrap;
    background-color: #ddd;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#eee), to(#ccc));
    background-image: -webkit-linear-gradient(top, #eee, #ccc);
    background-image: -moz-linear-gradient(top, #f3f3f3, #ddd);
    background-image: -ms-linear-gradient(top, #eee, #ccc);
    background-image: -o-linear-gradient(top, #eee, #ccc);
     background-image: linear-gradient(top, #f3f3f3, #ddd);
            
    border: 1px solid #777;
    padding-top: 2px;
    padding-right: 8px;
    padding-bottom: 2px;
    padding-left: 34px;
    margin: 0.2em;
    font: Roboto, Arial, Helvetica;
    font-weight:400;
    font-size:12px !important;
    line-height: 12px;
    text-decoration: none;
    color: #222;
    text-shadow: 0 1px 0 rgba(255,255,255,.8);
    border-radius: 2px;
    box-shadow: 0 0 1px 1px rgba(255,255,255,.8) inset, 0 1px 0 rgba(0,0,0,.3);
}

.button:hover {
    background-color: #eee;        
    background-image: -webkit-gradient(linear, left top, left bottom, from(#fafafa), to(#ddd));
    background-image: -webkit-linear-gradient(top, #fafafa, #ddd);
    background-image: -moz-linear-gradient(top, #fafafa, #ddd);
    background-image: -ms-linear-gradient(top, #fafafa, #ddd);
    background-image: -o-linear-gradient(top, #fafafa, #ddd);
    background-image: linear-gradient(top, #fafafa, #ddd);     
}

.button:active {
    -moz-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
    -webkit-box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
     box-shadow: 0 0 4px 2px rgba(0,0,0,.3) inset;
     position: relative;
     top: 1px;
}

</style>
   
      <!-- Do NOT change these rows - reads system variables -->
      <script src="index_vars.js"></script>
      <script src="/pow_vars.js"></script>     
    

</head>
<body> 

      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><img src="/res/topbar-logo.png" /></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         <ul class="nav navbar-nav">            
          <div id="textMenuID"></div>                       
         </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>  
    


<div id="detail-container">

<ol id="details">
	<li class="title">Details for Web Page files:</li>
	<li>Total Directories Scanned: <strong><?php echo $totalDirectories; ?></strong></li>
	<li>Total Files Located: <strong><?php echo $totalFiles; ?></strong></li>
	</ol>
<ol id="legend">
	<li class="title">Legend:</li>
	<li class="folder">Folder</li>
	<li class="file">File</li>
</ol>
<ol id="files">
	<li class="title">Main Folder Files:</li>
	<li class="file">index.htm</li>
	<li class="file">side-folders.htm</li>
</ol>
<ol id="search">
<li class="title">Updating Search:</li>
<li style="margin-left:-30px;c">Writing Search Files</li>
<li style="margin-left:-30px;"><progress style="margin-bottom:-4px;" value="0" max="10" id="progressBar"></progress></li>
</ol>
<div class="clear"></div>
</div>

<script>
var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("progressBar").value = 10 - --timeleft;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},50);
</script>

<script>
    // Get variables for page text, filename etc
    var all = document.getElementsByTagName("var");
    for(var i=0; i<all.length; i++) {
        var elm = all[i];
        var key = elm.innerHTML;
        if(VARS[key] != null)
            elm.innerHTML = VARS[key];
        else
            elm.innerHTML = "";
    }
    
    
   // Scroll to top button     
    function scrollWin() {
      window.scrollTo(0, 0);
    }          

</script>


<hr />
<div class="page-bg-not">
<?php
# Output the buffer
echo $tmp;
?>
</div>

  <!-- Bootstrap Core JavaScript -->
<?php if(file_exists($root.'res/bootstrap/bootstrap.min.js')) { ;?>  
    <script src="/res/bootstrap/bootstrap.min.js"></script>  
  <?php } else { ;?> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php } ;?>

</body>
</html>
<?php


/**
 * Recursively scans the directory
 *
 * @param string $directory - Directory to scan
 * @param array $searchFilter - Array of serch data
 * @param array $ignore - Array of data to ignore
 * @param int $depth - Flag for knowing the depth of the scan
 * @throws Exception
 */
function customScanDir($directory = '.', $searchFilter = NULL, $ignore = NULL, $depth = 0) {
      
    if ( MAX_SCAN_DEPTH && $depth > MAX_SCAN_DEPTH ) return array();
    
    if ( substr($directory, -1) == '/' ) {
        $directory = substr($directory, 0, -1);
    }
    
    try {
        try {
            $directory_tree = array(); // Define output array
            foreach (new DirectoryIterator($directory) as $fileInfo) {
                if ( $fileInfo->isDot() ) continue;
                
                $subdirectories = explode('/', $fileInfo->getPathname());
                $tmpName = end($subdirectories);                
                
                if ( $fileInfo->isDir() && !empty($ignore['directory']) && !in_array($tmpName, $ignore['directory']) ) {
                    $directory_tree['directory'][] = array('path'=>$fileInfo->getPathname(), 'name'=>$tmpName, 'kind'=>'directory', 'content'=>array_sort(customScanDir($fileInfo->getPathname(), $searchFilter, $ignore, $depth + 1), 'name'));
                    
                } else if ( $fileInfo->isFile() ) {
                    $tmpExtension = strtolower(end(explode('.', $tmpName)));
                    
                    # Ignored files and extensions
                    if ( !empty($ignore['extension']) && in_array($tmpExtension, $ignore['extension']) || !empty($ignore['file']) && in_array(strtolower($tmpName), $ignore['file']) || !empty($searchFilter['extension']) && !in_array($tmpExtension, $searchFilter['extension']) ) {
                        continue;
                    }
                    
                    # Add the file to the tree if it is searched or we are displaying the entire directory
                    if ( empty($searchFilter['file']) || !empty($searchFilter['file']) && in_array(strtolower($tmpName), $searchFilter['file']) ) {
                        $directory_tree['file'][] = array('name'=>$tmpName, 'extension'=>$tmpExtension, 'path'=>$fileInfo->getPathname(), 'lastModified'=>date('M d Y h:i:s a', $fileInfo->getMTime()), 'kind'=>'file');                        
                    }
                }
            }
            
            unset($tmpName, $tmpExtension); // Free tmp vars
            return $directory_tree;
        } catch ( UnexpectedValueException $e ) {
            throw new Exception(sprintf("Directory [%s/] contained a directory that cannot be stepped into", $directory), E_USER_WARNING);
            return array(); // Return an empty array
        }
    } catch ( Exception $e ) {
        die($e->getMessage()); // Show the error
    }
      
}

/**
 * Steps throught the directory array and displays
 *
 * @param array $fileSystem - Array of file system
 * @param int $totalFiles - Flag to count the total files found
 * @param int $totalDirectories - Flag to count the total directories scanned
 * @param int $depth - Flag to know the depth of the display
 */

function displayDirRecursively($fileSystem = array(), & $totalFiles = 0, & $totalDirectories = 0, $depth = 0,$search_file)  {
    
    echo '<ul class="' . (($depth) ? "sub-depth-{$depth}" : 'dirList') . '">';
    foreach ($fileSystem as $fsType=>$fsData) {
        foreach ($fsData as $item) {
            if ( $fsType === 'directory' ) {
                ++$totalDirectories;
                                
            // read text file in  dir and save to file            
              $search_text  = file_get_contents($item['name']."/search_vars.txt"); 
              $search_tags  = file_get_contents($item['name']."/search_tags.txt"); 
              $search_text = trim( str_replace( ﻿, '', $search_text ) );  // filter out strange character that disables search.
              $search_tags = trim( str_replace( ﻿, '', $search_tags ) );  // filter out strange character that disables search.
              file_put_contents("search_content.js",$search_text, FILE_APPEND);
              file_put_contents("search_tags.tmp",$search_tags.' ', FILE_APPEND);
            
                if (file_exists($item['name'].'/pow-edit.php')) {  
                echo '<li class="folder">';                
                echo '<b>'.$item['name'].'</b>';
                                
                $folder = $item['name'];
                $folder = str_replace('\\', '/', $folder);
                $folder = str_replace(' ', '%20', $folder);
                //$folder = array_map("htmlspecialchars", $folder); 
                //$folder = array_map("htmlspecialchars", $folder, array(ENT_QUOTES, 'UTF-8'));
                echo '&nbsp;&nbsp;&nbsp;<a href='.$folder.'/ target="_self" class="button">&#128270; View Page</a>';   // open pow-edit.php 
                echo '&nbsp;&nbsp;&nbsp;<a href='.$folder.'/pow-edit.php target="_self" class="button">&#128270; Edit Page</a>';   // open pow-edit.php in folder.
                  
                echo ' - <b>Search Tags:</b> '.$search_tags ;                        
                

                if ( isset($item['content']) && is_array($item['content']) && !empty($item['content']) ) {
                    displayDirRecursively($item['content'], $totalFiles, $totalDirectories, $depth + 1);
                }
                $deep = 0;
                echo '</li>'; 
                
// --- WRITING SIDE-FOLDERS.HTM ---
// --------------------------------                

$myfile = fopen($item['name'].'/side-folders.htm', "w") or die("Unable to open file!");

$directories = '';
$directories = scandir($item['name']);

$txt = '<ul class="side-pages">'. PHP_EOL;
//fwrite($myfile, pack("CCC",0xef,0xbb,0xbf)); // Creates UTF-8 file
fwrite($myfile, $txt);

foreach($directories as $directory){   

      
      
     if($directory =='.' ){
      //  echo '<b> Scanning Folders - Writing File</b> '.$item['name'].'\side-folders.htm<br>';
    }          
      
    else if ( $directory =='..'){
        // '<li><a href="../">Up</a></li>'; 
        // echo '<li><a href="../">Up</a></li>'; 
      //  echo '';      
    }  
     else if ( $directory=='dev'){
      // echo '<li><a href="../">Dev Test</a></li>';
      //  echo '';
    }    
      else if ( $directory =='res'){
       // echo '<li><a href="../">Resources</a></li>';
      //  echo '';
    } 
      else if ( $directory =='theme'){
       // echo '<li><a href="../">Theme</a></li>';
       // echo '';
    }     
      else if ( $directory =='system'){
       // echo '<li><a href="../">System</a></li>';
        echo '';
    }         
    else {
             
            if(is_dir($item['name'].'./'.$directory)){
                        
              // Get title tag from index_vars.js in subfolder
              $get_tags  = file_get_contents($item['name'].'/'.$directory.'/index_vars.js'); 
              preg_match('|VARS.title = "(.*)"|', $get_tags, $match) ; 
              $title = $match[1];
              
              if (empty($title)){ 
              $title = $directory ; 
              }     
                                                                                                
              $txt1 = '<li><a href="'.$directory.'">'.ucfirst($title).'</a></li>'. PHP_EOL;
              fwrite($myfile, $txt1);
                                                                       
            }
       }
} 

$txt_ul = '</ul>'. PHP_EOL;
fwrite($myfile, $txt_ul);
fclose($myfile); 


//echo '<div>File written</div>';                
                              
                }
                
            } else if ( $fsType === 'file' ) {
                ++$totalFiles;
                
                echo '<li class="file">';
                echo sprintf('<a href="%s" target="_blank" title="%s">%s</a>', $item['path'], $item['path'], $item['name']);
                //echo '<a href="powedit.php" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp; Edit</a>';    // To be done - open mcedit in folder.
                echo '</li>';
            }
        }
    }
    echo '</ul>';
     
    
}

 

/**
 * Sorts an array by key
 *
 * @param array $array
 * @param mixed $on - string||int
 * @param bool $sortASC - TRUE sort ASC, FALSE sort DESC
 * @return array
 */
function array_sort($array, $on, $sortASC = TRUE) {
    $new_array = array();
    $sortable_array = array();
    
    if ( count($array) > 0 ) {
        foreach ($array as $k=>$v) {
            if ( is_array($v) ) {
                foreach ($v as $k2=>$v2) {
                    if ( $k2 == $on ) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        
        if ( $sortASC ) {
            asort($sortable_array);
        } else {
            arsort($sortable_array);
        }
        
        foreach ($sortable_array as $k=>$v) {
            $new_array[$k] = $array[$k];
        }
    }
    
    return $new_array;
}


file_put_contents("search_content.js", "]};" . PHP_EOL, FILE_APPEND);
fclose("search_content.js"); 
//echo '<font color="red">Search File Closed</font>'; 
// file_put_contents("search_tags.htm", "]};" . PHP_EOL, FILE_APPEND);
fclose("search_tags.tmp"); 

$string  = file_get_contents("search_tags.tmp");  // for pow-scan.php
  $string = str_replace('  ', ' ', $string);
  $string = str_replace('.', '', $string);
  $string = str_replace('-', '', $string);
  $string = str_replace(',', '', $string);

function sortstring($string) { // removes nation chars
  //$array = explode(' ',strtolower($string) );
  $array = explode(' ',$string );  
  if ($unique) $array = array_unique($array);
  sort($array);
  return implode(' ',$array);  
}

//mb_strtolower($str, 'UTF-8');
//mb_strtolower($string,mb_detect_encoding($string));

//echo '<b>National chars Exist</b> - '. $string.'<br>';  // test of words   -national chars lost

$string = sortstring($string) ;

//echo '<b>National chars  - NOT Exist</b> - '. $string.'<br>';  // test of words   -national chars lost

//echo $string.' exist2<br>';  // test of words   -national chars lost
//$string = preg_replace("/([,.?!])/"," \\1",$string);

$parts = explode(" ",$string);
$unique = array_unique($parts);
$unique = implode(" ",$unique);

function str_to_url($s, $case=0){
	$acc =	'É	Ê	Ë	š	Ì	Í	ƒ	œ	µ	Î	Ï	ž	Ð	Ÿ	Ñ	Ò	Ó	Ô	Š	£	Õ	Ö	Œ	¥	Ø	Ž	§	À	Ù	Á	Ú	Â	Û	Ã	Ü	Ä	Ý	';
	$str =	'E	E	E	s	I	I	f	o	m	I	I	z	D	Y	N	O	O	O	S	L	O	O	O	Y	O	Z	S	A	U	A	U	A	U	A	U	A	Y	';
	$acc.=	'Å	Æ	ß	Ç	à	È	á	â	û	Ĕ	ĭ	ņ	ş	Ÿ	ã	ü	ĕ	Į	Ň	Š	Ź	ä	ý	Ė	į	ň	š	ź	å	þ	ė	İ	ŉ	Ţ	Ż	æ	ÿ	';
	$str.=	'A	A	S	C	a	E	a	a	u	E	i	n	s	Y	a	u	e	I	N	S	Z	a	y	E	i	n	s	z	a	p	e	I	n	T	Z	a	y	';
	$acc.=	'Ę	ı	Ŋ	ţ	ż	ç	Ā	ę	Ĳ	ŋ	Ť	Ž	è	ā	Ě	ĳ	Ō	ť	ž	é	Ă	ě	Ĵ	ō	Ŧ	ſ	ê	ă	Ĝ	ĵ	Ŏ	ŧ	ë	Ą	ĝ	Ķ	ŏ	';
	$str.=	'E	l	n	t	z	c	A	e	I	n	T	Z	e	a	E	i	O	t	z	e	A	e	J	o	T	i	e	a	G	j	O	t	e	A	g	K	o	';
	$acc.=	'Ũ	ì	ą	Ğ	ķ	Ő	ũ	í	Ć	ğ	ĸ	ő	Ū	î	ć	Ġ	Ĺ	Œ	ū	ï	Ĉ	ġ	ĺ	œ	Ŭ	ð	ĉ	Ģ	Ļ	Ŕ	ŭ	ñ	Ċ	ģ	ļ	ŕ	Ů	';
	$str.=	'U	i	a	G	k	O	u	i	C	g	k	o	U	i	c	G	L	O	u	i	C	g	l	o	U	o	c	G	L	R	u	n	C	g	l	r	U	';
	$acc.=	'ò	ċ	Ĥ	Ľ	Ŗ	ů	ó	Č	ĥ	ľ	ŗ	Ű	ô	č	Ħ	Ŀ	Ř	ű	õ	Ď	ħ	ŀ	ř	Ų	ö	ď	Ĩ	Ł	Ś	ų	Đ	ĩ	ł	ś	Ŵ	ø	đ	';
	$str.=	'o	c	H	L	R	u	o	C	h	l	r	U	o	c	H	L	R	u	o	D	h	l	r	U	o	d	I	L	S	c	D	i	l	s	W	o	d	';
	$acc.=	'Ī	Ń	Ŝ	ŵ	ù	Ē	ī	ń	ŝ	Ŷ	Ə	ú	ē	Ĭ	Ņ	Ş	ŷ	 	:	;	.	,';
	$str.=	'I	N	S	w	u	E	i	n	s	Y	e	u	e	I	N	S	y	-	-	-	-	-';

	$out = str_replace(explode("\t", $acc), explode("\t", $str), $s);

	if($case == -1){
		//return strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $out));
		return preg_replace('/[^a-zA-Z0-9_-]/', '', $out);
	}else if($case == 1){
		//return strtoupper(preg_replace('/[^a-zA-Z0-9_-]/', '', $out));
		return preg_replace('/[^a-zA-Z0-9_-]/', '', $out);
	}else{
		return preg_replace('/[^a-zA-Z0-9_-]/', '', $out);
	}
} // end str_to_url

//echo str_to_url('zażółć GęŚLĄ JAŹń!!!', -1);

$search_tags  = fopen("search_tags.htm", "w") or die("Unable to open file!"); 
fwrite($search_tags, pack("CCC",0xef,0xbb,0xbf));
$intro = " Click on a word:";
file_put_contents("search_tags.htm",$intro, FILE_APPEND);
      
      $Array  = explode(' ',$unique) ;   
      foreach($Array as $key => $value) {
      
     $urlval = str_to_url($value, -1);
     $urlval = str_replace('_', '%20', $urlval);
     $value = str_replace('_', ' ', $value);

      $tag = ' <a href="/search.htm?q='.$urlval.'" class="tag_word" >'.ucfirst($value).'</a>&nbsp;&nbsp; ';
     // echo $tag ;
      file_put_contents("search_tags.htm",$tag, FILE_APPEND);
      $tag='';	   
      }
       
fwrite($search_tags, $tag.' ');
fclose($search_tags);   


?>


<!-- - - - - - - writing side-menu.htm - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - -->

<?php
      echo '<ul class="sidebar-nav"><h3>Writing Site Map file side-menu.htm</h3>';
      $mymenu = fopen("theme/side-menu.htm", "w") or die("Unable to open file!");
      $menu_txt = '<ul class="sidebar-nav">'. PHP_EOL;  
      fwrite($mymenu, $menu_txt);
      
       $menu_txt = 
       '<li class="sidebar-brand">
        <a href="#" onclick="pageReload(); return false;"><var>navigate</var> <i class="fa fa-refresh"></i></a>
        </li>' .PHP_EOL.PHP_EOL;
       fwrite($mymenu, $menu_txt);
  
      $path = "./";
       $dir = new DirectoryIterator($path);    
       //$dir = new LimitIterator($dir_iterator, 'res');
       
  
      foreach ($dir as $dirInfo) {
        if ($dirInfo->getFilename() != "res" && $dirInfo->getFilename() != "system" && $dirInfo->getFilename() != "theme"  ) {
     
          if ($dirInfo->isDir() && !$dirInfo->isDot()) {
              $subPath = $path.$dirInfo->getFilename();
              //echo $subPath ;
              $subDir = new DirectoryIterator($subPath);
        
              echo '<li><a href="/'.$dirInfo.'">'.strtoupper($dirInfo->getFilename()).'</a><ul>'.PHP_EOL;
              
              $get_tags  = file_get_contents($dirInfo->getFilename().'/index_vars.js'); 
              preg_match('|VARS.title = "(.*)"|', $get_tags, $match) ; 
              $title = $match[1]; 
              
              if (empty($title)){ 
              $title = $dirInfo->getFilename(); 
              }                 
                                                                    
              // $txt =  '<li><a href="/'.$dirInfo.'">'.strtoupper($dirInfo->getFilename()).'</a>'.PHP_EOL.'<ul>'.PHP_EOL;
                $txt =  '<li><a href="/'.$dirInfo.'">'.strtoupper($title).'</a>'.PHP_EOL.'<ul>'.PHP_EOL;
                fwrite($mymenu, $txt);
                copy('index.htm', $dirInfo.'/index.htm'); 
                copy('pow-edit.php', $dirInfo.'/pow-edit.php'); 
                rename($dirInfo.'/index_vars.txt', $dirInfo.'/index_vars.js'); // renames incoming index_vars.txt in zip      
                                          
                     
               foreach ($subDir as $subPath) {
                  if ($subPath->isDir() && !$subPath->isDot()) {
                  
                      $sub2Path = $path.$dirInfo.'/'.$subPath->getFilename();   // subsub
                      $sub2Dir = new DirectoryIterator($sub2Path);  // subsub
                     // echo $sub2Path ; // subsub
                                       
                      $get_tags  = file_get_contents($dirInfo.'/'.$subPath->getFilename().'/index_vars.js'); 
                      preg_match('|VARS.title = "(.*)"|', $get_tags, $match) ; 
                      $title = $match[1]; 
                      
                      if (empty($title)){ 
                      $title = $subPath->getFilename(); 
                      }                           
                     
                      echo '<li><a href="/'.$dirInfo.'/'.$subPath.'">'.ucfirst($subPath->getFilename()).'</a></li>'.PHP_EOL;
                   //  $txt = '<li><a href="/'.$dirInfo.'/'.$subPath.'">'.ucfirst($subPath->getFilename()).'</a></li>'.PHP_EOL;
                      $txt = '<li><a href="/'.$dirInfo.'/'.$subPath.'">'.ucfirst($title).'</a></li>'.PHP_EOL;
                     fwrite($mymenu, $txt);
                     copy('index.htm', $dirInfo.'/'.$subPath.'/index.htm');
                     copy('pow-edit.php', $dirInfo.'/'.$subPath.'/pow-edit.php');
                     rename($dirInfo.'/'.$subPath.'/index_vars.txt', $dirInfo.'/'.$subPath.'/index_vars.js'); // renames incoming index_vars.txt in zip
                     
                     foreach ($sub2Dir as $sub2Path) {
                      if ($sub2Path->isDir() && !$sub2Path->isDot()) {                     
                      copy('index.htm', $dirInfo.'/'.$subPath.'/'. $sub2Path .'/index.htm');
                      copy('pow-edit.php', $dirInfo.'/'.$subPath.'/'. $sub2Path .'/pow-edit.php'); 
                                                                  
                      rename($dirInfo.'/'.$subPath.'/'.$sub2Path.'/index_vars.txt', $dirInfo.'/'.$subPath.'/'.$sub2Path.'/index_vars.js'); // renames incoming index_vars.txt in zip
                     }
                    } // foreach sub2dir
                  }
                }
              
              echo '</ul></li>'.PHP_EOL;
               $txt = '</ul>'.PHP_EOL.'</li>'.PHP_EOL.PHP_EOL;  
               fwrite($mymenu, $txt);  
          }
         } // end res exclude  
      }
      echo '</ul>'.PHP_EOL;
  $menu_txt = PHP_EOL.'</ul>';
  fwrite($mymenu, $menu_txt);
  fclose($mymenu);   
  

  
  ?>