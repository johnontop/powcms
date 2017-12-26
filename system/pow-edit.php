<?php
ini_set('display_errors', '0'); 
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('Europe/Berlin');

/*  http://yagudaev.com/posts/resolving-php-relative-path-problem/ */
$root = $_COOKIE['root']; 

/* COOKIE LOGIN CHECK - for valid username and passwords - Change password in /pow-config.php*/
include  $root.'pow-config.php' ;

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    
    if (($_COOKIE['username'] = $user) || ($_COOKIE['password'] = sha1($pass))) {            
        // echo 'Welcome back ' . $_COOKIE['username'];
    } else {        
        header('Location: /pow-login.php');
    }    
  } else {
    header('Location: /pow-login.php');    
  } // END COOKIE LOGIN CHECK
  
include $root . 'theme/translation.'.$lang_code.'.php';

rename('index_vars.txt', 'index_vars.js'); // renames incoming index_vars.txt in zip

if ($sqlite == 1){  // check ig sqlite is enbled in pow-config.php
$db_file = $root.'system/sqlite/powcms.db';
$db = new SQLite3($db_file);
   if(!$db) {
      $message = "No database " . $db->lastErrorMsg();
   } else {
      $message = "Opened SQLite database";
   }
} 

if ($sqlite == 0){  // check ig sqlite is enbled in pow-config.php  
  $message = "SQLite database is disabled";
} 
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; encoding=utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  

  <title>POW Editor v4.7.4</title>
  
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
   
    <!-- Custom styles for index.htm wrapper page -->    
    <link href="/theme/default.css" rel="stylesheet">   
    
    <style>
    
      .fa-pencil-square-o { 
       color:#333;
      }  
      
     input[type=text] {       
       padding-top: 0px;
       padding-left: 5px;
       padding-bottom: -0px;
       padding-right: 1px;
       height:22px;              
      }

     .writing-file { /* position of folder info */
        position: absolute; 
        left: 1125px; 
        top: 55px;        
       }
       
     .folder-tree {  /* position of foler tree */
        position: absolute;  
        left: 1090px; 
        top: 210px;
     }
     
     .edit-vars {
        position: absolute;  
        left: 900px; 
        top: 105px;
     }     
     
      .vars-input {  /* input field labels */
        font-size: 11px;
        font-family:Arial; 
        font-weight:400;  
        margin-top:5px; 
        margin-bottom:2px;     
   } 
   
.custom-file-input::-webkit-file-upload-button {
  visibility: hidden;
}
.custom-file-input::before {
  content: url(/res/open.png);
  display: inline-block;
 /* background: -webkit-linear-gradient(top, #f9f9f9, #e3e3e3);
  border: 1px solid #999;
  border-radius: 2px;
  margin-top:4px;
    text-shadow: 1px 1px #fff;
  font-weight: 700;
  font-size: 10pt;
  padding: 0px 0px;
  */
    
  outline: none;
  white-space: nowrap;
  -webkit-user-select: none;
  cursor: pointer;
}
.custom-file-input:hover::before {
  border-color: black;
}
.custom-file-input:active::before {
  background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
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
    padding-top: 0px;
    padding-right: 8px;
    padding-bottom: 0px;
    padding-left: 8px;
    margin: 0.2em;
    font: Roboto, Arial, Helvetica;
    font-weight:400;
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

.button:focus {
    outline: 0;
    background: #fafafa;
}    

.button:before {
    background: #eee;
    background: rgba(0,0,0,.1);
    float: left;        
    width: 1em;
    text-align: center;
    font-size: 13px;
    margin: 1 0.8em 0 -1em;
    padding: 0 .2em;
    box-shadow: 1px 0 0 rgba(0,0,0,.5), 2px 0 0 rgba(255,255,255,.5);
    border-radius: .15em 0 0 .15em;
    pointer-events: none;        
}

/* Hexadecimal entities for the icons 
https://www.computerhope.com/htmcolor.htm
*/

.blue-bg {
   background-color: #E1FFD6;
}

.add:before {
    content: "\271A";
}

.edit:before {
    content: "\270E";        
}

.delete:before {
    content: "\2718";        
}

.save:before {
    content: "\2714";        
}

.email:before {
    content: "\2709";        
}

.like:before {
    content: "\2764";        
}

.next:before {
    content: "\279C";
}

.star:before {
    content: "\2605";
}

.spark:before {
    content: "\2737";
}

.play:before {
    content: "\25B6";
}
    </style>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins and reading files via index_vars.js) -->    
<?php if(file_exists($root.'res/js/jquery.min.js')) { ;?>  
    <script src="/res/js/jquery.min.js"></script>
  <?php } else { ;?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php } ;?>    
    
    <!-- Colorbox jQuery CSS for html popu wih iframes, image slide shows, picture viewing -->
    <link href="/res/colorbox/colorbox.css" rel="stylesheet"> 
     
    <!-- Colorbox jQuery plugin for html popu wih iframes, image slide shows, picture viewing -->
    <script src="/res/colorbox/jquery.colorbox-min.js"></script>        

  <?php if ($tooltip == 1){  ?>   <!-- check if $spellcheck is enbled in user-pass.php -->  
    <link rel="stylesheet" type="text/css" href="/res/tooltip/jquery.qtip.css">
    <script src="/res/tooltip/jquery.qtip.min.js" type="text/JavaScript"></script>
  <?php } ?>     
    
    <script src="/res/datetime/datetimepicker_css.js"></script> 
    
    <script src="index_vars.js"></script>

<?php include  $root.$editor ;?>



<script>
       // qTip2 in /res/tootip folder
       $(document).ready(function() {
         // By suppling no content attribute, the library uses each elements title attribute by default
           $('[title]').qtip({
               content: {
                text: false // Use each elements title attribute
                },
            position: {
               my: 'top center',  // Position my top center...
               at: 'bottom center', // at the bottom center of...        
           },                
             style: 'cream' // Give it some style
         });
       // NOTE: You can even omit all options and simply replace the regular title tooltips like so:
         // $('#content a[href]').qtip();
   });
   
  
</script>

</head>
<body>

 <input name="image" type="file" id="upload" style="display:none;" onchange="">
 
<?php include $root.'pow-menu.php' ; ;?>

<!--  
    <a class="button" href="javascript:;" onmousedown="addImage()">Insert Logo</a>
    <a class="button" href="javascript:;" onmousedown="getHtml('/layouts/thumbnail.htm')">Insert Layout Test</a>
    <input type="file" id="fileInput" multiple onchange="getFilename()" accept=".html"/>
--> 

<script type="text/javascript">
function addImage(){
//tinymce.get("savecontent").execCommand('mceInsertContent', false, 'your content');
tinymce.get("savecontent").execCommand('mceInsertContent',false,'<br><img alt="$img_title" src="/theme/topbar-logo.png" />');
}
</script>

<script type="text/javascript">

    function getFilename () {
      var name = document.getElementById('fileInput'); 
     var filename = '/res/layouts/'+ name.value ;
     // var filename = '/layouts/thumbnail.htm';  
     // alert('Selected file: ' + name.value);
      //alert(filename.value);
     getHtml(filename) ;
    };
    
    function getHtml(file){
        var html; 
         $.get(file, function(data) {
             html=data;
          }).done(function(){
        addHtml(html);
          })};         
      
    function addHtml(newContent){
    tinymce.get("savecontent").execCommand('mceInsertContent', false, newContent);
}
</script>


<!-- - - - - - - reading index_vars.js - - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - --> 
    
<?php  

$vars  = file_get_contents("index_vars.js"); 
//$vars = utf8_decode($vars);
          
preg_match('|VARS.title = "(.*)"|', $vars, $match) ; 
$title = $match[1];
if (empty($title)){$title = ucfirst(basename(__DIR__)) ; }

preg_match('|VARS.file_name = "(.*)"|', $vars, $match) ;
$file_name = $match[1];
if (empty($file_name)){$file_name = basename(__DIR__).".htm" ; }

preg_match('|VARS.author = "(.*)"|', $vars, $match) ; 
$name = $match[1];
if (empty($name)){$name = ucfirst($user) ; }

preg_match('|VARS.data = "(.*)"|', $vars, $match) ;
$data = $match[1];

preg_match('|VARS.category = "(.*)"|', $vars, $match) ;
$category = $match[1];

preg_match('|url : "(.*)"|', $vars, $match) ;
$load_file_not = $match[1];

preg_match('|VARS.date = "(.*)"|', $vars, $match) ;
$date = $match[1];
if (empty($date)){$date = date("Y-m-d H:i") ; }

preg_match('|VARS.image = "(.*)"|', $vars, $match) ;
$image = $match[1];

preg_match('|VARS.description = "(.*)"|', $vars, $match) ; 
$description = $match[1];

preg_match('|VARS.tags = "(.*)"|', $vars, $match) ; 
$tags = $match[1];
//echo "Page tags: ".$tags;
//echo "<br><br>";
?>


<div style="display: inline; position: absolute; width:300px; left: 1000px; top: 70px; ">
<?php
// Test of folder paths
//echo "Path: ".realpath($load_file)." - " ;
//echo "Load: ".$load_file." - " ;
//echo "Save: ".$save_file ;
//echo getcwd() ;
//echo $file_name;
?>
</div>


<!-- - - - - - -  load choosen HTML file   - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - --> 

<?php
// Make folder and copy pow-edit.php
$add_folder = $_POST['add_folder'];  
if($add_folder) {
if (!is_dir($add_folder)) {
    $add_folder = str_to_url($add_folder, -1);
    mkdir($add_folder, 0777, true);
    copy("pow-edit.php" , $add_folder."/pow-edit.php");
    copy("index.htm" , $add_folder."/index.htm");
    $clear = "";
}
?>
<script>
    $('#variables').submit();
</script>
<?php
} 

$loadcontent = $file_name;
$fp = @fopen($loadcontent, "r");
$loadcontent = fread($fp, filesize($loadcontent));
//$loadcontent = utf8_decode(htmlspecialchars($loadcontent));
$loadcontent = htmlspecialchars($loadcontent);
fclose($fp); 

$load_file = $_POST['load_file'];  // Added
$save_file = $_POST['save_file'];
//$file_name = $_POST['file_name'];   
$savecontent = $_POST['savecontent'];

if($load_file) {
$loadcontent = $load_file;
// echo $loadcontent;
//$loadcontent = $file.".htm";
if (!is_writable($loadcontent)) {
echo '<font color="red" size="4" style="font-size:18px;position: relative;left: 60px; bottom: 5px;">Error - You can only open files in current folder</font> '.realpath($load_file);
} else {
$loadcontent = $load_file;
$fp = @fopen($loadcontent, "r");
$loadcontent = fread($fp, filesize($loadcontent));
//$loadcontent = utf8_decode(htmlspecialchars($loadcontent));
$loadcontent = htmlspecialchars($loadcontent);
fclose($fp);  
}
}

if($save_file) {
$loadcontent = $file_name; // added for test
$savecontent = stripslashes($savecontent);
$html_text = $savecontent ;
$fp = @fopen($loadcontent, "w");
$loadcontent=$savecontent; // utf8 bom
if ($fp) {
//echo 'File Saved';
$status = 'File Saved';
//fwrite($fp, utf8_encode($savecontent));
fwrite($fp, pack("CCC",0xef,0xbb,0xbf)); 
fwrite($fp, $savecontent);
fclose($fp);
}

if ($sqlite == 1){  // CHECK if sqlite is enbled in user-pass.php
$html_text = str_replace("'", "´", $html_text);
$saved = date("Y-m-d H:i") ;
	// Makes query with post data
	$query = "INSERT INTO pages (title, filename, name, saved, date, data_id, tags, description, html_text ) VALUES ('$title', '$file_name', '$name', '$saved', '$date', '$data', '$tags', '$description', '$html_text' )";
//echo 'TEST '.$html_text ;	
	// Executes the query
	// If data inserted then set success message otherwise set error message
	// Here $db comes from "db_connection.php"
	if( $db->exec($query) ){
		$message = "Data is inserted into <a href='/system/sqlite/phpliteadmin.php?table=pages&action=row_view' target='_blank' >SQLite</a>";
	}else{
		$message = "Sorry, Data is not inserted into <a href='/system/sqlite/phpliteadmin.php?table=pages&action=row_view' target='_blank' >SQLite</a>";
	}
 } // end sqlite check	
}  // end save file	
?>

<!-- - - - - - - - show TinyMCE section - - - - - - - -->
<!-- - - - - - - - - - - - - -  - - - - - - - - - - - --> 
 <?php echo $message ;?>
<form action="<?=$_SERVER['PHP_SELF']?>"  method="post">
<div style="display: inline; position: relative; width:600px; left: 33px; top: 7px; right: 20px;">

<label for="choose" class="button blue-bg" title="<?php echo tooltip_Open_File ;?>" ><?php echo Open_File ;?></label>
<input style="display: inline;display:none;" type="file" id="choose" name="load_file"  accept=".htm,.html" value="./">

<input style="display: inline;" class="button blue-bg" type="submit" title="<?php echo tooltip_Load ;?>" value="<?php echo Load ;?>"> 
Name: <input style="display: inline;" type="text" name="file_name" size="15" value="<?php echo $load_file ;?>" > 
<a href="#" class="iframe" form="form_word" onclick="location.href='index.htm';" ><img src="/res/view.png" title="Experimental popup view of doc"></a>
<input form="form_word" class="button" type="submit" name="submit_word" title="Under development - but functional." value=" Word" />
<a class="button" href="pow-edit.php?zip=1" title="Creates ZIP file with all sub folders" ">ZIP</a>
<a class="button" href="pow-edit.php?nozip=1" title="Undo ZIP functions renaming of index_vars.js files in all sub folders" ">noZIP</a>
<a class="button" href="javascript:;" title="Inserts Logo file: topbar-logo.png from /theme folder " onmousedown="addImage()">Insert Logo</a>

<label for="fileInput" class="button blue-bg" title="Insert HTML text template into textarea" ><?php echo Layouts ;?></label>
<input style="display: inline;display:none;" type="file" id="fileInput" name="insert_htm"  multiple onchange="getFilename()" accept=".html"/>
<!--
<a class="button" href="javascript:;" onmousedown="getHtml('/layouts/thumbnail.htm')">Insert Layout</a>
 -->
<input style="position:relative;left: 0px;" type="button" onclick="location.href='index.htm';" class="button blue-bg" title="View Edited Page" value="<?php echo View_Page ;?>" />

</div>
</form>

  <script>    
   var loc = window.location.pathname;
   var dir = loc.substring(0, loc.lastIndexOf('/'));
   document.write("<p style='font-size:14px;position: absolute;left: 230px; top: 50px;'>File: " + dir + "/" + VARS.file_name + "</p>");       
  </script> 

<form name="text_save" style="position: relative; width:785px; left: 35px; top: 7px;" enctype="multipart/form-data" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<textarea  class="myBasicEditor" name="savecontent" id="savecontent" >
<?=$loadcontent?>
</textarea>

<input type="submit" name="save_file" title="Save text to disk with file name <?php echo $file_name ;?>" value="<?php echo Save ;?>" style="position: absolute; top:2px; right: 2px; color:#009933 ;">  
<div style="position: absolute; top:2px; right: 80px"><?php echo $status ;?></div>
<input type="hidden" name="file_name" value="<?php echo $load_file ;?>">
</form>

<?php
if($_POST['submit_vars']) {
$title = $_POST['title'];
$name = $_POST['name'];
$file_name = $_POST['file_name']; 
$data = $_POST['data'];
$date = $_POST['date'];
$category = $_POST['category'];
$image = $_POST['image']; 
$tags = $_POST['tags'];
$description = $_POST['description'];
}
?>                                    

<div style="display: inline; position: absolute; width:250px; left: 850px; top: 55px;">
    <form id="variables" class="" method="post" action="pow-edit.php">
					
		<h4>Page Variables</h4>
		
		<div>
		  <label class="vars-input" for="name" title="Tooltip - "><i class="fa fa-info-circle" ></i> Page Title - shown on top of page (<font color="red">required</font>)</label>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="35" this.value='<?php echo $title ;?>';" placeholder="Enter Page Title" "style="color: #000;" value="<?php echo $title ;?>"/> 
		</div> 

		<div>
		  <label class="vars-input" for="file_name" title="Tooltip - "><i class="fa fa-info-circle" ></i> File Name - file name for html page (<font color="red">required</font>)</label>
			<input id="file_name" name="file_name" class="element" type="text" maxlength="255" size="35" this.value='<?php echo $file_name ;?>';" placeholder="Enter Filename" "style="color: #000;" value="<?php echo $file_name ;?>"/> 
		</div> 		  		
	
		<div>
		  <label class="vars-input" for="data" title="Tooltip - "><i class="fa fa-info-circle" ></i> Data ID - value used in database (optional)</label>
			<input id="data" name="data" class="element" type="text" maxlength="255"  size="35" value="<?php echo $data ;?>"/> 
		</div> 

		<div>
		  <label class="vars-input" for="category" title="Tooltip - "><i class="fa fa-info-circle" ></i> Category - value used in database (optional) </label>
			<input id="category" name="category" class="element" type="text" maxlength="255" size="35" value="<?php echo $category ;?>"/> 
		</div>      

		<div>
		  <label class="vars-input" for="date" title="Date/time will be used for search functions later - In SQLite database current date/time for each save is stored."><i class="fa fa-info-circle" ></i> Date - Public release date (adviced)</label>
			<input id="date" name="date" class="element" type="text" maxlength="255" size="30" value="<?php echo $date ;?>"/> 
			<img src="/res/datetime/images2/cal.gif" onclick="javascript:NewCssCal('date','yyyyMMdd','dropdown',true,'24')"  style="cursor:pointer"/>
		</div>      

		<div>
		  <label class="vars-input" for="name" title="Author - the authors name"><i class="fa fa-info-circle" ></i> Author - name of author. (adviced)</label>
			<input id="name" name="name" class="element" type="text" maxlength="255" size="35" value="<?php echo $name ;?>"/> 
		</div>              			
    		
		<div>
		  <label class="vars-input" for="tags" title="Tag Words - to keep a name intact in the 'Tag Search' use an underscore instead of the space character."><i class="fa fa-info-circle" ></i> Page Tags - used in search function (<font color="red">adviced</font>)</label>
			<input id="tags" name="tags" class="element" type="text" maxlength="255" size="35" value="<?php echo $tags ;?>"/> 
		</div> 
        		
		<div>
		  <label class="vars-input" for="description" title="This is the description shown in the Search function. Don´t use character double quotes in the text, since it will be removed or search to stop working. Keep the description within the box- it is around 160 characters."><i class="fa fa-info-circle" ></i> Description - used in search function (<font color="red">adviced</font>)</label>
			<textarea id="description" name="description" cols="40" rows="6" class="element textarea small"><?php echo $description ;?></textarea> 
		</div> 
		
		<div>
		  <label class="vars-input" for="image" title="Tooltip - "><i class="fa fa-info-circle" ></i> Image - Load image into themes (optional)</label>
			<input id="image" name="image" class="element" type="text" maxlength="255" size="30" value="<?php echo $image ;?>"/> 
			<label class="custom-file-input"  for="Upload" ></label><input id="Upload" style="padding-top:20x; display:none;" type="file" multiple="multiple" name="_photos" accept="image/*" style="visibility: hidden">
		</div> 
    		
     
    <input id="saveForm" class="button" type="submit" name="submit_vars" value=" Save & Update Page Variables " />     
    
    <!-- 
     <input type="hidden" name="form_id-not" value="regex" />
     <input type="button" onclick="location.href='pow-vars.php';" value="Edit Page Variables" />
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Update Page Variables" /> 
    <input type="button" onclick="location.href='pow-edit.php';" value="Edit Page" />
    -->

		</form>	
    </div>
 
<div style="position: absolute; left: 530px; top: 86px;">    
<form id="form_word" class="" method="post" action="/pow-word.php">
<input id="title" name="title" class="element" type="hidden" maxlength="255" size="35" value="<?php echo $title ;?>"/> 
<textarea style="display:none" id="description" name="description" cols="40" rows="6" class="element textarea small"><?php echo $description ;?></textarea>
<textarea style="display:none" id="text" name="text" cols="40" rows="6" class="element textarea small"><?php echo $loadcontent ;?></textarea>
      
</form>	
</div> 
    
    
    <div style="position: absolute; left: 1130px; top: 530px;"> 
     <img src="<?php echo $image ;?>" height="100px" />
     <p class="small"><?php echo $image ;?></p> 
    </div> 
     
     
<!-- - - - - - - writing search_vars.txt - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->     

<?php
//$description = htmlspecialchars($description);
if($_POST['submit_vars']) {
$description = str_replace('"', "´", $description);
$description = trim( str_replace( PHP_EOL, ' ', $description ) );
//$description = preg_replace('/\r?\n$/', ' ', $description);
$search_text = '{"title": "'.$title.'", "text": "'.$description.'", "tags": "'.$tags.'", "date": "'.$date.'", "url": "'. dirname($_SERVER['PHP_SELF']) .'/index.htm"},' ;
//$search_text = utf8_encode($search_tex);

//echo "<br>".$search_text."<br><br>";

$search_vars  = fopen("search_vars.txt", "w") or die("Unable to open file!");
fwrite($search_vars, pack("CCC",0xef,0xbb,0xbf));   
fwrite($search_vars, $search_text);
fclose($search_vars); 
} 
?>

<!-- - - - - - - - writing index_vars.js - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->  

<?php

if($_POST['submit_vars']) {
$index_text = '    VARS = {};
    VARS.title = "'.$title.'";
    VARS.author = "'.$name.'";
    VARS.file_name = "'.$file_name.'";
    VARS.data = "'.$data.'";
    VARS.category = "'.$category.'";
    VARS.date = "'.$date.'";
    VARS.image = "'.$image.'";
    VARS.tags = "'.$tags.'";
    VARS.description = "'.$description.'";
                
        $.ajax({            
            url : "'.$file_name.'",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textFileID").html(data); }}); 
         
    // Get Image for page           
            $(function() {
            $("#image_load").append("<img src='.$image.'>"); });               
            
    // Get Folders menu
        $.ajax({
            url : "side-folders.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textFolderID").html(data); }});      

    // Get Pages menu
        $.ajax({
            url : "/theme/side-pages.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textPagesID").html(data); }});      
      
        
    // Get Links menu
        $.ajax({
            url : "/theme/side-links.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textLinksID").html(data); }});   
            
        
    // Get Links Side menu
        $.ajax({
            url : "/theme/side-menu.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textSideMenu").html(data); }});                         
            
    // Get Links top menu
        $.ajax({
            url : "/theme/top-menu.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textMenuID").html(data); }});            
            
            ' ;
        

$index_vars  = fopen("index_vars.js", "w") or die("Unable to open file!"); 
fwrite($index_vars, pack("CCC",0xef,0xbb,0xbf));  
//fwrite($index_vars, utf8_encode($index_text));
fwrite($index_vars, $index_text);
fclose($index_vars); 

$search_tags  = fopen("search_tags.txt", "w") or die("Unable to open file!"); 
fwrite($search_tags, pack("CCC",0xef,0xbb,0xbf));  
fwrite($search_tags, $tags.' ');
fclose($search_tags); 
} 

?>   

<!-- - - - - - - showing side-folders.htm  - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->

<div class="folder-tree"> 

<?php 
$directories = scandir('./');

echo '<ul>'; 

foreach($directories as $directory){
      
    if($directory=='.' ){
        echo '<b style="margin-left: 0px;">Edit Folder Pages</b>';
    }   
    else if ( $directory=='..'){
        echo '<li style="list-style-type: none;"><a href="javascript:history.go(-2)"><i class="fa fa-pencil-square-o" ></i> Up</a></li>';        
    }   
  else if ( $directory=='dev'){
       echo '<li style="list-style-type: none;"><a href="res/pow-edit.php"><i class="fa fa-pencil-square-o" ></i> Dev-test (hidden)</a></li>';
       // echo '';
    }     
  else if ( $directory=='res'){
       echo '<li style="list-style-type: none;"><a href="res/pow-edit.php"><i class="fa fa-pencil-square-o" ></i> Res (hidden)</a></li>';
       // echo '';
    } 
  else if ( $directory=='theme'){
       echo '<li style="list-style-type: none;"><a href="theme/pow-edit.php"><i class="fa fa-pencil-square-o" ></i> Theme (hidden)</a></li>';
       // echo '';
    }     
  else if ( $directory=='system'){
       echo '<li style="list-style-type: none;"><a href="system/pow-edit.php"><i class="fa fa-pencil-square-o" ></i> System (hidden)</a></li>';
       // echo '';
    }           
    else{               
         if(is_dir($directory)){                  
            echo '<li style="list-style-type: none;"><a href="'.$directory .'/pow-edit.php"><i class="fa fa-pencil-square-o" ></i> '.ucfirst($directory).'</a></li>';                            
         }
    }
} 
echo '</ul>'; 

?>
</div>  <!-- end showing side-folders.htm -->

<!-- - - - - - - writing side-folders.htm  - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->

<div class="writing-file"> 

<h4>Folders</h4>

<?php

$myfile = fopen("side-folders.htm", "w") or die("Unable to open file!");

$directories = scandir('./');

$txt = '<ul class="side-pages">'. PHP_EOL; 
//fwrite($myfile, pack("CCC",0xef,0xbb,0xbf)); // Creates UTF-8 file
fwrite($myfile, $txt);

foreach($directories as $directory){
      
    if($directory=='.' ){
        echo '<b>Writing Folder File</b><br>side-folders.htm<br>';
    }          
      
    else if ( $directory=='..'){
         '<li><a href="../">Up</a></li>';
        
    }  
      else if ( $directory=='dev'){
       // echo '<li><a href="../">Development</a></li>';
        echo '';
    }    
      else if ( $directory=='res'){
       // echo '<li><a href="../">Resources</a></li>';
        echo '';
    } 
      else if ( $directory=='theme'){
       // echo '<li><a href="../">Theme</a></li>';
        echo '';
    }     
      else if ( $directory=='system'){
       // echo '<li><a href="../">System</a></li>';
        echo '';
    }         
    else{
               
            if(is_dir($directory)){
            
              $get_tags  = file_get_contents($directory.'/index_vars.js'); 
              preg_match('|VARS.title = "(.*)"|', $get_tags, $match) ; 
              $title = $match[1];
              
                 if (empty($title)){ 
                  $title = $directory ;                   
                 } 
                  
                  $txt = '<li><a href="'.$directory.'">'.ucfirst($title).'</a></li>'. PHP_EOL;
                  fwrite($myfile, $txt);
            }
    }
} 

$txt = '</ul>'. PHP_EOL; 
fwrite($myfile, $txt);
fclose($myfile); 
//echo '<div>File written</div>';
?> 
<progress value="0" max="8" id="progressBar"></progress>
<br>
<b>Add New Folder</b>
<form action="<?=$_SERVER['PHP_SELF']?>"  method="post">
<input id="add_folder" name="add_folder" class="element" type="text" maxlength="255" size="15" value="<?php echo $clear ;?>"/> 
<button class="button" type="submit" value="submit_folder" id="submit_folder" ><i class="fa fa-check"></i></button> 
</form>
</div>   

<script>
function size_it()
{
//Specifying the height of the field where the edits are done. You may have to alter the pixel-value (method: trial and error)
document.getElementById('savecontent').style.height=window.innerHeight-150+'px'
}
size_it()   
</script>

<script>
var timeleft = 5;
var downloadTimer = setInterval(function(){
  document.getElementById("progressBar").value = 10 - --timeleft;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},500);
</script>

<script type="text/javascript">
function call_popup()
{

jQuery.colorbox({width:"550px", height:"380px",html:'<div class="modal-body"><h3>Scanning Folders and Updating Files!</h3><ul><li>This will take a couple of seconds</li><li>Clear Browser Cache to see these Updates</li><li>Coyping files and updating folders</li><li>Scanning folders for Word Tags and descriptions</li><li>Writing file for Search function</li><li>Updating Search function</li><li>Writing Side Menu File</li><li>Writing Folder Lists Files</li><br><progress value="0" max="8" id="updateBar"></progress></ul></div>'});

            $('#cboxClose').remove();
            setTimeout(function(){
              $(window).colorbox.close();
            }, 7000)
            
$.ajax({ 
    url: "/pow-update.php?action=update",
    success: 
        function(data)
        {
           // here, for example, you load the data received from pow-update.php into
           // an html element with id #content and show an alert message
           // $("#content").html(data);
           // alert("Success")
        }
});   

var timeleft = 10;
var downloadTimer = setInterval(function(){
  document.getElementById("updateBar").value = 10 - --timeleft;
  if(timeleft <= 0)
    clearInterval(downloadTimer);
},800);       
           
}
</script>

<script>
$(document).keydown(function(e) {
    if ((e.key == 's' || e.key == 'S' ) && (e.ctrlKey || e.metaKey))
    {
        e.preventDefault();
        alert("Ctrl-s pressed");
        return false;
    }
    return true;
}); 
</script>

  <!-- Bootstrap Core JavaScript -->
<?php if(file_exists($root.'res/bootstrap/bootstrap.min.js')) { ;?>  
    <script src="/res/bootstrap/bootstrap.min.js"></script>  
  <?php } else { ;?> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php } ;?>

</body>
</html> 

 

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

?>
<script>
    alert("You can not zip the root folder, because the system folder and resources folders would be included. \n\nThese folders can not be sent by mail in a zip files since mail providers blocks .exe, .bat and .js files\n");
</script>
<?php

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
//echo "<br>Zipping " . $path. "<br />";
$zip = new ZipArchive();
$zip->open($zipname.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($files as $name => $file)
{
	if ($file->isDir()) {
	
	  if(!in_array($file, $no_zip)) {
	 	
  	     rename($file.'/index_vars.js', $file.'/index_vars.txt'); // renames index_vars.js to index_vars.txt in zip
         		   
        // if(basename(dirname(__FILE__))=='pages' ){echo '<b style="margin-left: 0px;">Skip powcms </b>';}
         // echo $file . "<br>";
      flush();           
		  continue;
		}
	}
	
	$filePath = $file->getRealPath();
    $relativePath = substr($filePath, strlen($path) + 1);	            
    $zip->addFile($filePath, $relativePath);
}
$zip->close();
// echo "Created zip file: ". $zipname.'.zip';
?>
<script>
    alert("\nCreated zip file: <?php echo $zipname ?>.zip with all sub folders in the <?php echo $zipname ?> folder. \n\nThe side-menu.js file are renamed and zip file is ready to mail. \n\nRun System Update to rebuild the side menus.");
</script>
<?php

} // end $zipfiles 2
} // end zipsub

  if (isset($_GET['zip'])) {
    zipsub(2);
  }
  

// renames index_vars.js to index_vars.txt in file system  
if (isset($_GET['nozip'])) {
$path = realpath(__DIR__);
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($files as $name => $file)
{
	if ($file->isDir()) {		 	
  	     rename($file.'/index_vars.txt', $file.'/index_vars.js'); // renames index_vars.js to index_vars.txt in zip         		           
      //   echo $file . "<br>";
      flush();           
		  continue;
	}
}      
}  

function str_to_url($s, $case=0){ // filter nationional chars when creating a folder
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
?>
