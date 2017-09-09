<?php
ini_set('display_errors', '0');

/* COOKIE LOGIN CHECK - These are our valid username and passwords - Change password here and in login.php*/
$user = 'admin';
$pass = 'password';

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    
    if (($_COOKIE['username'] = $user) || ($_COOKIE['password'] = md5($pass))) {            
        // echo 'Welcome back ' . $_COOKIE['username'];
    } else {        
        header('Location: http://localhost/pow-login.php');
    }    
  } else {
    header('Location: http://localhost/pow-login.php');    
  } // END COOKIE LOGIN CHECK
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; encoding=utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
<!-- http://mesdomaines.nu/eendracht/rte/tinymce_explanations.html
<meta http-equiv="Content-Type" content="text/html; charset="utf-8" > 
<meta charset="utf-8">
 -->

  <title>POW CMS Editor</title>
  
   <!-- Bootstrap -->
   <link href="http://localhost/res/bootstrap/bootstrap.min.css" rel="stylesheet">  
   
    <!-- Custom Fonts --> 
    <link href="http://localhost/res/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
   
    <!-- Custom styles for index.htm wrapper page -->
    <link href="http://localhost/res/default.css" rel="stylesheet">
    <link href="http://localhost/theme/default-mod.css" rel="stylesheet">   
    
    <style>

     .writing-file { /* position of folder info */
        position: absolute; 
        left: 1125px; 
        top: 80px;        
       }
       
     .folder-tree {  /* position of foler tree */
        position: absolute;  
        left: 1100px; 
        top: 150px;
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
    </style>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins and reading files via index_vars.js) -->
    <script src="http://localhost/res/js/jquery.min.js"></script>
    
<link rel="stylesheet" type="text/css" href="http://localhost/res/tooltip/tooltip.css">
<script src="http://localhost/res/tooltip/tooltip.js" type="text/JavaScript"></script>   
<script src="http://localhost/res/datetime/datetimepicker_css.js"></script> 
    
    <script src="index_vars.js"></script>

  <!-- This is the line that does almost everything. We can find it at http://www.tinymce.com/index.php  -->
  <script src="http://localhost/res/tinymce/tinymce.min.js"></script>


<script type="text/javascript">
tinymce.init({
        mode : "specific_textareas",
        editor_selector : "myBasicEditor", 
        //selector: ".",
        entity_encoding : "raw",
        height : "380px",
        theme: 'modern',
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
        ],

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

        menubar: true,
        toolbar_items_size: 'small',

        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
        ],
        content_css: [
        'https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i'    
        ]        
});
</script>

</head>
<body onload = "tooltip.init ()">

      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://localhost/"><img src="http://localhost/res/bar-logo.png" /></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
         <ul class="nav navbar-nav">      
            <li><a href="http://localhost/index.htm">Root</a></li>                                      
            <li><a href="http://localhost/pages">Pages</a></li>  
            <li><a href="http://localhost/pow-search.htm">Search</a></li>                                                                        
            <li><a href="http://localhost/templates">Templates</a></li>                                                               
            <li><a href="http://localhost/sysinfo">System Info</a></li> 
            <li><a href="http://localhost/sysinfo/Page Editor">Editor Help</a></li>
            <li><a href="http://localhost/pow-scan.php" title="This function will update the search function &lt;br /&gt; with the tags and description you have written" ><i class="fa fa-info-circle" ></i> Update Search</a></li>
            <li><a href="http://localhost/pages/updatefiles.php" title="If you have created new sub folder this &lt;br /&gt; function  will copy needed files to the folders,&lt;br /&gt; so you can edit them." ><i class="fa fa-info-circle" ></i> Copy Folder Files</a></li>
            <li><a href="http://localhost/pow-login.php">Logout</a></li>             
            <li><a href="javascript:history.go(-1)" title="Tooltip - "><i class="fa fa-arrow-circle-left" ></i> Back</a></li>               
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- Thanks to http://www.dreamincode.net/forums/topic/9866-textarea-editor for the php part -->

  <script>    
   var loc = window.location.pathname;
   var dir = loc.substring(0, loc.lastIndexOf('/'));
   document.write("<p style='font-size:18px;position: relative;left: 60px; top: 5px;'>Edit Folder/File: " + dir + "/" + VARS.file_name + "</p>");       
  </script> 

<?php
ini_set('display_errors', '0'); 
ini_set('default_charset', 'UTF-8');
header("Content-type: text/html; charset=utf-8; encoding=utf-8;");            

//include "system/login-check.php" ;
//$file = "tinymce_save";
$load_file = $_POST['load_file'];  // Added
$save_file = $_POST['save_file'];
$file_name = $_POST['file_name'];   
$savecontent = $_POST['savecontent'];
?>

<div style="display: inline; position: absolute; width:300px; left: 400px; top: 60px; ">
<?php
// Test of folder paths
//echo "Path: ".realpath($load_file)." - " ;
//echo "Load: ".$load_file." - " ;
//echo "Save: ".$save_file ;
//echo getcwd() ;
?>
</div>

<?php
if($load_file) {
$loadcontent = $load_file;
// echo $loadcontent;
//$loadcontent = $file.".htm";
if (!is_writable($loadcontent))
echo '<font color="red" size="4" style="font-size:18px;position: relative;left: 60px; bottom: 5px;">Error - You can only open files in current folder</font> '.realpath($load_file);
}

if($save_file) {
$loadcontent = $file_name; // added for test
$savecontent = stripslashes($savecontent);
$fp = @fopen($loadcontent, "w");
$loadcontent=$savecontent; // utf8 bom
if ($fp) {
//echo 'File Saved';
$status = 'File Saved';

//fwrite($fp, $savecontent);
fwrite($fp, utf8_encode($savecontent));
fclose($fp);
}
}  // end save file

$fp = @fopen($loadcontent, "r");
$loadcontent = fread($fp, filesize($loadcontent));
$loadcontent = utf8_decode(htmlspecialchars($loadcontent));
fclose($fp);  

?>



<form action="<?=$_SERVER['PHP_SELF']?>"  method="post">
<div style="display: inline; position: relative; width:400px; left: 60px; top: 0px; right: 20px;">
<input style="display: inline;" type="file" name="load_file" title="Browse files in current folder.&lt;br /&gt; Then click load button." accept=".htm,.html" value="./">
<input style="display: inline;" type="submit" value="Load"> 
Name: <input style="display: inline;" type="text" name="file_name" value="<?php echo $load_file ;?>" > 
<input type="button" onclick="location.href='index.htm';" title="Tooltip - " value="View Page" />
</div>
</form>


<form style="position: relative; width:780px; left: 40px; top: 10px;" enctype="multipart/form-data" method="post" action="<?=$_SERVER['PHP_SELF']?>">
<textarea  class="myBasicEditor" name="savecontent" id="savecontent" >
<?=$loadcontent?>
</textarea>

<input type="submit" name="save_file" value="Save" style="position: absolute; top:2px; right: 2px; color:#009933 ;">  
<div style="position: absolute; top:2px; right: 80px"><?php echo $status ;?></div>
<input type="hidden" name="file_name" value="<?php echo $load_file ;?>">
</form>

<!-- showing side-folders.htm 
  ----------------------------->

<div class="folder-tree"> 

<?php 
$directories = scandir('./');

echo '<ul>'; 

foreach($directories as $directory){
      
    if($directory=='.' ){
        echo '<b style="margin-left:-13px;">Navigate Folders</b>';
    }   
    else if ( $directory=='..'){
        echo '<li><a href="../">Up</a></li>';
    }   
  else if ( $directory=='res'){
       echo '<li><a href="res/">Res (hidden)</a></li>';
       // echo '';
    } 
  else if ( $directory=='theme'){
       echo '<li><a href="theme/">Theme (hidden)</a></li>';
       // echo '';
    }     
  else if ( $directory=='system'){
       echo '<li><a href="system/">System (hidden)</a></li>';
       // echo '';
    }           
    else{               
         if(is_dir($directory)){                  
            echo '<li><a href="'.$directory .'">'.ucfirst($directory).'</a></li>';                            
         }
    }
} 
echo '</ul>'; 

?>
</div>  <!-- end showing side-folders.htm -->

<!-- writing side-folders.htm 
 ------------------------------>
 
<div class="writing-file"> 

<?php
$myfile = fopen("side-folders.htm", "w") or die("Unable to open file!");

$directories = scandir('./');

$txt = '<ul class="side-pages">'. PHP_EOL; 
//fwrite($myfile, pack("CCC",0xef,0xbb,0xbf)); // Creates UTF-8 file
fwrite($myfile, $txt);

foreach($directories as $directory){
      
    if($directory=='.' ){
        echo '<b>Writing file</b><br>side-folders.htm<br>';
    }   
    else if ( $directory=='..'){
         '<li><a href="../">Up</a></li>';
        
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
                  
                  $txt = utf8_encode('<li><a href="'.$directory .'">'.ucfirst($directory).'</a></li>'). PHP_EOL;
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
</div>

<!-- reading index_vars.js 
  ----------------------------->
<?php  

$vars  = file_get_contents("index_vars.js"); 
$vars = utf8_decode($vars);
          
preg_match('|VARS.name = "(.*)"|', $vars, $match) ; 
$name = $match[1];

preg_match('|VARS.data = "(.*)"|', $vars, $match) ;
$data = $match[1];

preg_match('|VARS.category = "(.*)"|', $vars, $match) ;
$category = $match[1];

preg_match('|VARS.file_name = "(.*)"|', $vars, $match) ;
$file_name = $match[1];

preg_match('|url : "(.*)"|', $vars, $match) ;
$load_file = $match[1];

preg_match('|VARS.date = "(.*)"|', $vars, $match) ;
$date = $match[1];

preg_match('|VARS.image = "(.*)"|', $vars, $match) ;
$image = $match[1];

preg_match('|VARS.description = "(.*)"|', $vars, $match) ; 
$description = $match[1];

preg_match('|VARS.tags = "(.*)"|', $vars, $match) ; 
$tags = $match[1];
//echo "Page tags: ".$tags;
//echo "<br><br>";

if($_POST['submit']) {
$name = $_POST['name'];
$file_name = $_POST['file_name']; 
$tags = $_POST['tags'];
$description = $_POST['description'];
$category = $_POST['category'];
$data = $_POST['data'];
$date = $_POST['date'];
$image = $_POST['image']; 
}

?>                                    

    <div style="display: inline; position: absolute; width:250px; left: 850px; top: 70px;">
    <form id="regexp" class="" method="post" action="pow-edit.php">
					
		<h4>Page Variables</h4>
		
		<div>
		  <label class="vars-input" for="name" title="Tooltip - "><i class="fa fa-info-circle" ></i> Page Title - Title shown on top of page (<font color="red">required</font>)</label>
			<input id="name" name="name" class="element" type="text" maxlength="255" size="35" value="<?php echo $name ;?>"/> 
		</div> 

		<div>
		  <label class="vars-input" for="file_name" title="Tooltip - "><i class="fa fa-info-circle" ></i> File Name - File loaded into web page (<font color="red">required</font>)</label>
			<input id="file_name" name="file_name" class="element" type="text" maxlength="255" size="35" value="<?php echo $file_name ;?>"/> 
		</div> 		

    <!--
		<div>
		  <label class="vars-input" for="load_file">Load File</label><br>
			<input id="load_file" name="load_file" class="element" type="text" maxlength="255" size="35" value="<?php //echo $load_file ;?>"/> 
		</div> 
    -->    		
	
		<div>
		  <label class="vars-input" for="data" title="Tooltip - "><i class="fa fa-info-circle" ></i> Data ID - Used as value in database (optional)</label>
			<input id="data" name="data" class="element" type="text" maxlength="255"  size="35" value="<?php echo $data ;?>"/> 
		</div> 

		<div>
		  <label class="vars-input" for="category" title="Tooltip - "><i class="fa fa-info-circle" ></i> Category - Used as value in database (optional) </label>
			<input id="category" name="category" class="element" type="text" maxlength="255" size="35" value="<?php echo $category ;?>"/> 
		</div>  
    
		<div>
		  <label class="vars-input" for="image" title="Tooltip - "><i class="fa fa-info-circle" ></i> Image - Load image into themes (optional)</label>
			<input id="image" name="image" class="element" type="text" maxlength="255" size="35" value="<?php echo $image ;?>"/> 
		</div> 
    
		<div>
		  <label class="vars-input" for="date" title="Tooltip - "><i class="fa fa-info-circle" ></i> Date - For coming functions (adviced)</label>
			<input id="date" name="date" class="element" type="text" maxlength="255" size="30" value="<?php echo $date ;?>"/> 
			<img src="http://localhost/res/datetime/images2/cal.gif" onclick="javascript:NewCssCal('date','yyyyMMdd','dropdown',true,'24')"  style="cursor:pointer"/>
		</div>           			
    		
		<div>
		  <label class="vars-input" for="tags" title="Tooltip - "><i class="fa fa-info-circle" ></i> Page Tags - Used in search function (<font color="red">required</font>)</label>
			<input id="tags" name="tags" class="element" type="text" maxlength="255" size="35" value="<?php echo $tags ;?>"/> 
		</div> 
        		
		<div>
		  <label class="vars-input" for="description" title="This is the description shown in the search function. Don´t use characters like single or double quotes in the text, since it will cause the search to stop working".><i class="fa fa-info-circle" ></i> Description - Used in search function (<font color="red">required</font>)</label>
			<textarea id="description" name="description" cols="40" rows="6" class="element textarea small"><?php echo $description ;?></textarea> 
		</div> 
     
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Update Page Variables" />     
    
    <!-- 
     <input type="hidden" name="form_id-not" value="regex" />
     <input type="button" onclick="location.href='pow-vars.php';" value="Edit Page Variables" />
    <input id="saveForm" class="button_text" type="submit" name="submit" value="Update Page Variables" /> 
    <input type="button" onclick="location.href='pow-edit.php';" value="Edit Page" />
    -->

		</form>	
    </div>
    
    <div style="position: absolute; left: 1110px; top: 480px;"> 
     <img src="<?php echo $image ;?>" height="100px" />
    </div>  

<?php
//$description = htmlspecialchars($description);

$description = str_replace('"', "'", $description);
$description = trim( str_replace( PHP_EOL, ' ', $description ) );
//$description = preg_replace('/\r?\n$/', ' ', $description);
$search_text = '{"title": "'.$name.'", "text": "'.$description.'", "tags": "'.$tags.'", "date": "'.$date.'", "url": "http://localhost'. dirname($_SERVER['PHP_SELF']) .'/index.htm"},' ;
//$search_text = utf8_encode($search_tex);

//echo "<br>".$search_text."<br><br>";

$search_vars  = fopen("search_vars.txt", "w") or die("Unable to open file!");  
fwrite($search_vars, $search_text);
fclose($search_vars); 


$index_text = '    VARS = {};
    VARS.title = "'.$name.'";
    VARS.name = "'.$name.'";
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
            url : "side-pages.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textPagesID").html(data); }});      
      
        
    // Get Links menu
        $.ajax({
            url : "side-links.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textLinksID").html(data); }});             
            ' ;
        

$index_vars  = fopen("index_vars.js", "w") or die("Unable to open file!"); 
fwrite($index_vars, pack("CCC",0xef,0xbb,0xbf));  
fwrite($index_vars, utf8_encode($index_text));
fclose($index_vars); 

$search_tags  = fopen("search_tags.txt", "w") or die("Unable to open file!"); 
fwrite($search_tags, pack("CCC",0xef,0xbb,0xbf));  
fwrite($search_tags, utf8_encode($tags.' '));
fclose($search_tags); 

?>      

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

    <!-- Bootstrap Core JavaScript -->
    <script src="http://localhost/res/bootstrap/bootstrap.min.js"></script>

</body>
</html> 