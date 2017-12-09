<?php
ini_set('display_errors', '0'); 
ini_set('default_charset', 'UTF-8');

/* COOKIE LOGIN CHECK - This will chack valid username and passwords - Change password in system/pow-config.php*/
include 'pow-config.php' ;

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    
    if (($_COOKIE['username'] = $user) || ($_COOKIE['password'] = sha1($pass))) {            
        // echo 'Welcome back ' . $_COOKIE['username'];
    } else {        
        header('Location: http://localhost/pow-login.php');
    }    
  } else {
    header('Location: http://localhost/pow-login.php');    
  } // END COOKIE LOGIN CHECK
  
$root = $_COOKIE['root'];  
include $root . '/theme/translation.'.$lang_code.'.php';
  

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; encoding=utf-8" >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  

  <title>POW Customize & Translate</title>
  
  <!-- Bootstrap -->
<?php if(file_exists($root.'res/bootstrap/bootstrap.min.css')) { ;?>  
   <link href="/res/bootstrap/bootstrap.min.css" rel="stylesheet">  
  <?php } else { ;?> 
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php } ;?>   
   
  <!-- Custom Fonts -->          
<?php if(file_exists('$root.res/font-awesome/css/font-awesome.min.css')) { ;?>  
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
    <link href="/theme/custom.css" rel="stylesheet">    
    
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
        top: 165px;
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
    
    <link rel="stylesheet" type="text/css" href="/res/tooltip/tooltip.css">
    <script src="/res/tooltip/tooltip.js" type="text/JavaScript"></script>   
    <script src="/res/datetime/datetimepicker_css.js"></script> 
    
    <script src="index_vars.js"></script>
    <script src="pow_vars.js"></script>


<?php  

$vars  = file_get_contents("pow_vars.js"); 
//$vars = utf8_decode($vars);
   
preg_match('|VARS.lang_code = "(.*)"|', $vars, $match) ; 
$lang_code_not = $match[1];

preg_match('|VARS.language = "(.*)"|', $vars, $match) ; 
$language_not = $match[1];

preg_match('|VARS.system_name = "(.*)"|', $vars, $match) ; 
$system_name = $match[1];
                    
preg_match('|VARS.system_title = "(.*)"|', $vars, $match) ; 
$system_title = $match[1];

preg_match('|VARS.system_tagline = "(.*)"|', $vars, $match) ; 
$system_tagline = $match[1];

preg_match('|VARS.system_version = "(.*)"|', $vars, $match) ; 
$system_version = $match[1];

preg_match('|VARS.version_history = "(.*)"|', $vars, $match) ; 
$version_history = $match[1];

preg_match('|VARS.licenses = "(.*)"|', $vars, $match) ;
$licenses = $match[1];

preg_match('|VARS.search = "(.*)"|', $vars, $match) ;
$search = $match[1];

preg_match('|VARS.search_pages = "(.*)"|', $vars, $match) ;
$search_pages = $match[1];

preg_match('|VARS.search_tags = "(.*)"|', $vars, $match) ;
$search_tags = $match[1];

preg_match('|VARS.pages_side = "(.*)"|', $vars, $match) ;
$pages_side = $match[1];

preg_match('|VARS.links_side = "(.*)"|', $vars, $match) ;
$links_side = $match[1];

preg_match('|VARS.page_top = "(.*)"|', $vars, $match) ;
$page_top = $match[1];

preg_match('|VARS.date = "(.*)"|', $vars, $match) ;
$date = $match[1];

preg_match('|VARS.image = "(.*)"|', $vars, $match) ;
$image = $match[1];

preg_match('|VARS.copyright = "(.*)"|', $vars, $match) ; 
$copyright = $match[1];

preg_match('|VARS.copyright_owner = "(.*)"|', $vars, $match) ; 
$copyright_owner = $match[1];

//echo "Page tags: ".$tags;
//echo "<br><br>";
?>

</head>
<body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
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
            <li><a href="/index.htm"><?php echo Start ;?></a></li>                                                   
            <li><a href="/search.htm"><?php echo Search ;?></a></li>                                                                                                                                                   
            <li><a href="/sysinfo"><?php echo SysInfo ;?></a></li>  
            <li><a href="/sysinfo/Page Editor">Editor Help</a></li>                       
          </ul>          
          
         <ul class="nav navbar-nav">                       
            
            <li><a href="/templates"><?php echo Templates ;?></a></li>
            <li><a title="Change System Username & Password, Web Title - Enable/Disable functions. Translations not fully functional yet. " href="/pow-custom.php"><i class="fa fa-key" ></i> <?php echo Customize ;?></a></li>         
            <li><a href="/pow-scan.php" title="Update the search function with the tags and description you have written. View Tags per Page." ><i class="fa fa-info-circle" ></i> <?php echo Update_Search ;?></a></li>
            <li><a href="#" id="confirm" onclick="call_popup(); return false;" title="If you have created new sub folder this function  will copy needed files to the folders, so you can edit text file in folder." ><i class="fa fa-info-circle" ></i> <?php echo System_Update ;?></a></li>
         
            <li><a href="/pow-login.php"><?php echo Logout ;?></a></li>             
            <li><a href="javascript:history.go(-1)" title="Tooltip - "><i class="fa fa-arrow-circle-left" ></i> <?php echo Back ;?></a></li>               
        </ul>                  
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<?php
if($_POST['submit_vars']) {    
$system_version = $_POST['system_version'] ;      
$language = $_POST['language'] ; 
$system_name = $_POST['system_name'] ;
$system_title = $_POST['system_title'] ;         
$system_tagline = $_POST['system_tagline'] ;
$system_version = $_POST['system_version'] ; 
$version_history = $_POST['version_history'] ;
$licenses = $_POST['licenses'] ;
$search = $_POST['search'] ;
$search_pages = $_POST['search_pages'] ;
$search_tags = $_POST['search_tags'] ;
$pages_side = $_POST['pages_side'] ;
$links_side = $_POST['links_side'] ;
$page_top = $_POST['page_top'] ;     
$copyright = $_POST['copyright'] ;
$copyright_owner = $_POST['copyright_owner'] ;     
$Translator_Name = $_POST['Translator_Name'] ;     
} 
?>

<!-- - - - - - - - writing pow_vars.js - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->  

<?php

if($_POST['submit_vars']) {
$system_text = 
' VARS.system_name = "'.$system_name.'";
 VARS.system_title = "'.$system_title.'";
 VARS.system_tagline = "'.$system_tagline.'";
 VARS.system_version = "'.$system_version.'"; 
 VARS.navigate = "Navigera";
 VARS.previous = "Previous Page";
 VARS.next = "Next Page";
 VARS.start = "Start Page";
 VARS.title_status = "Title";       // status
 VARS.category_status = "Category"; // status
 VARS.page_status = "Page";         // status
 VARS.data_status = "Data ID";      // status
 VARS.edit = "Edit Page";           // status
 VARS.root = "Start";               // top menu
 VARS.search = "'.$search.'";       // search page
 VARS.search_pages = "'.$search_pages.'";  // search page
 VARS.search_tags = "'.$search_tags.'";   // search page
 VARS.pages = "Pages";         // top menu
 VARS.index = "Index";         // top menu
 VARS.content = "Content";     // top menu 
 VARS.templates = "Templates"; // top menu
 VARS.sysinfo = "System Info"; // top menu
 VARS.back = "Back";           // top menu
 VARS.pages_side = "'.$pages_side.'";    // side menu
 VARS.links_side = "'.$links_side.'";    // side menu
 VARS.copyright_owner = "'.$copyright_owner.'";    // footer
 VARS.copyright = "'.$copyright.'";    // footer
 VARS.page_top = "'.$page_top.'";    // footer
 VARS.version_history = "'.$version_history.'";  // footer            
 VARS.licenses = "'.$licenses.'"; // footer
            ' ;
        
$index_vars  = fopen("pow_vars.js", "w") or die("Unable to open file!"); 
fwrite($index_vars, pack("CCC",0xef,0xbb,0xbf));  
//fwrite($index_vars, utf8_encode($index_text));
fwrite($index_vars, $system_text);
fclose($index_vars); 
echo "<meta http-equiv='refresh' content='0'>";
} 
?> 

<?php
if($_POST['submit_vars']) {
$translation_text = '<?php
define ("lang_code", "en");
define ("language", "'.$language.'");
define ("Translator_Name", "'.$Translator_Name.'"); // page variables
define ("system_title", "'.$system_title.'"); // page variables
define ("system_tagline", "'.$system_tagline.'"); // page variables
define ("system_version", "'.$system_version.'"); // page variables
define ("Version_History", "Version History"); // page variables
define ("Licenses", "Licenses"); // page variables
define ("Copyright", "'.$copyright.'"); // page variables
define ("Edit_Page", "Edit Page"); // index.htm
define ("Pages", "Pages"); // index.htm
define ("Links", "Links"); // index.htm
define ("Page_Top", "Page Top!"); // top menu
define ("Start_Page", "Start Page"); // side-pages,htm menu
define ("Previous_Page", "Previous Page"); // side-pages,htm menu
define ("Start", "Start"); // top menu
define ("Pages", "Pages"); // top menu
define ("Search", "'.$search.'");  // top menu
define ("Templates", "Templates"); // top menu
define ("Sysinfo", "Sysinfo"); // top menu
define ("Update_Search", "Update Search"); // top menu
define ("System_Update", "System Update"); // top menu
define ("Back", "Back"); // top menu
define ("Login", "Login"); // login pa

define ("Open_File", "Open File");   
define ("tooltip_Open_File", "Tip: HTML files must be opened in the current folder."); 
define ("Load", "Load");
define ("tooltip_Load", "Browse files in current folder. Then click load button.");
define ("View_Page", "View Page");

define ("Logout", "Logout"); // login page
define ("Username", "Username"); // login page
define ("Password", "Password"); // login page
define ("Page_Variables", "Page Variables"); // page
define ("Writing Folder File", "Writing Folder File"); // page
define ("Edit_Folder_Pages", "Folders"); // page
define ("Edit_Folder/File", "Edit Folder/File"); // page
define ("Folders", "Folders"); // page
define ("Folders", "Folders"); // page


define ("tooltip_Title", ""); // page variables
define ("tooltip_File_Name", ""); // page variables
define ("tooltip_Data_ID", ""); // page variables
define ("tooltip_Category", ""); // page variables
define ("tooltip_Date", ""); // page variables
define ("tooltip_Author", ""); // page variables
define ("tooltip_Page_Tags", ""); // page variables
define ("tooltip_Description", ""); // page variables
define ("tooltip_Image", ""); // page variables
define ("tooltip_Title", ""); // page variables 
?>';

$system_trans  = fopen("theme/translation.php", "w") or die("Unable to open file!"); 
fwrite($system_trans, pack("CCC",0xef,0xbb,0xbf));  
//fwrite($system_trans, utf8_encode($index_text));
fwrite($system_trans, $translation_text);
fclose($system_trans); 
} 

?>


<div style="display: inline; position: absolute; left: 40px; top: 60px; width:600px; ">
  <h4>Customize POW CMS </h4>
    
    
<form id="translation" class="" method="post" action="pow-custom.php">					
		<h4>English Original - <?php echo $language ;?> System Strings & Translation </h4>
				
        
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> POW CMS Version - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "v1.12" ;?>"/> 			
      <input id="title" name="system_version" class="element" type="text" maxlength="255" size="32" value="<?php echo $system_version ;?>"/>
		</div>
		           		
		<h4>Web Site Strings</h4>
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> CMS Site Name - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "POW CMS" ;?>"/> 			
      <input id="title" name="system_name" class="element" type="text" maxlength="255" size="32" value="<?php echo $system_name ;?>"/>
		</div> 
    		
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> CMS Header Title - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Portable Offline Web CMS" ;?>"/> 			
      <input id="title" name="system_title" class="element" type="text" maxlength="255" size="32" value="<?php echo $system_title ;?>"/>
		</div> 

		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> CMS Header Tagline - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Rocks the World!" ;?>"/> 			
      <input id="title" name="system_tagline" class="element" type="text" maxlength="255" size="32" value="<?php echo $system_tagline ;?>"/>
		</div> 
		
    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Copyright Owner - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "POW CMS 2017" ;?>"/> 			
      <input id="title" name="copyright_owner" class="element" type="text" maxlength="255" size="32" value="<?php echo $copyright_owner ;?>"/>
		</div> 			
		     
    <h4>Page Strings</h4>		

    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Search - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Search" ;?>"/> 			
      <input id="title" name="search" class="element" type="text" maxlength="255" size="32" value="<?php echo $search ;?>"/>
		</div>
    
    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Search - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Search Pages" ;?>"/> 			
      <input id="title" name="search_pages" class="element" type="text" maxlength="255" size="32" value="<?php echo $search_pages ;?>"/>
		</div>	
    
    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Search - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Search by Tags" ;?>"/> 			
      <input id="title" name="search_tags" class="element" type="text" maxlength="255" size="32" value="<?php echo $search_tags ;?>"/>
		</div>	        		
		
     		
    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Page Top - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Page Top!" ;?>"/> 			
      <input id="title" name="page_top" class="element" type="text" maxlength="255" size="32" value="<?php echo $page_top ;?>"/>
		</div> 		

    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Copyright - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Copyright" ;?>"/> 			
      <input id="title" name="copyright" class="element" type="text" maxlength="255" size="32" value="<?php echo $copyright ;?>"/>
		</div> 		
	
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> POW CMS Version - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Version History" ;?>"/> 			
      <input id="title" name="version_history" class="element" type="text" maxlength="255" size="32" value="<?php echo $version_history ;?>"/>
		</div>

		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> POW CMS Version - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Licenses" ;?>"/> 			
      <input id="title" name="licenses" class="element" type="text" maxlength="255" size="32" value="<?php echo $licenses ;?>"/>
		</div>
		

		<h4>Side Menu Strings</h4>

    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Start Page - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Pages" ;?>"/> 			
      <input id="title" name="pages_side" class="element" type="text" maxlength="255" size="32" value="<?php echo $pages_side ;?>"/>
		</div>
    
    <div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Start Page - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Links" ;?>"/> 			
      <input id="title" name="links_side" class="element" type="text" maxlength="255" size="32" value="<?php echo $links_side ;?>"/>
		</div> 		
	  		
    <br>
    <input id="saveForm" class="button" type="submit" name="submit_vars" value=" Update Customize & System Variables " />     

		</form>	
    </div>

<!-- - - - - - - - writing user_pass.php - - - - - - - -->
<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->  

<?php
if($_POST['submit_system']) {
$user = $_POST['user'];
$pass = $_POST['pass'];
 if(isset($_POST['sqlite'])){          
     $sqlite = $_POST['sqlite'];
   }  else{
     $sqlite=0;
   }
 if(isset($_POST['spellcheck'])){          
     $spellcheck = $_POST['spellcheck'];
   }  else{
     $spellcheck=0;
   }
 if(isset($_POST['tooltip'])){          
     $tooltip = $_POST['tooltip'];
   }  else{
     $tooltip=0;
   }
$ftp_host = $_POST['ftp_host'];
$ftp_user = $_POST['ftp_user'];
$ftp_pass = $_POST['ftp_pass'];
$language = $_POST['lang_code'];

$user_pass_text = '<?php 
$user = "'.$user.'"; // change username to your preference
$pass = "'.$pass.'"; // change password before upload to online server
$sqlite = "'.$sqlite.'"; // enable backup to SQLite database when saving text in Page Editor
$spellcheck = "'.$spellcheck.'"; // enable browser spellchecker in TinyMCE
$tooltip = "'.$tooltip.'"; // enable tooltip in Page Editor
$ftp_host = "'.$ftp_host.'"; // FTP host parameter
$ftp_user = "'.$ftp_user.'"; // FTP user parameter
$ftp_pass = "'.$ftp_pass.'"; // FTP password parameter
$editor = "pow-tinymce-inc.php"; // select HTML Editor
$lang_code = "'.$language.'"; // Language code for translation
?>           ' ;
        
$user_pass_file  = fopen("pow-config.php", "w") or die("Unable to open file pow-config.php");  
fwrite($user_pass_file, pack("CCC",0xef,0xbb,0xbf));  
//fwrite($index_vars, utf8_encode($index_text));
fwrite($user_pass_file, $user_pass_text);
fclose($user_pass_file); 
} 
?> 

<div style="display: inline; position: absolute; left: 555px; top: 90px; width:600px; ">

    <form id="translation" class="" method="post" action="pow-custom.php">
							
		
		<h4>User & System Settings</h4>
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Username - (pow-config.php)</label><br>
			<input id="user" name="user" class="element" type="text" maxlength="255" size="32" value="<?php echo $user ;?>"/> 			
		</div> 
		
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Password - (pow-config.php)</label><br>
			<input id="pass" name="pass" class="element" type="text" maxlength="255" size="32" value="<?php echo $pass ;?>"/> 			      
		</div> 		
    
		<div>
		  <label class="vars-input" for="sqlite" title=""><i class="fa fa-info-circle" ></i> SQLite enable/disable - (pow-config.php)</label><br>      			 
		<?php
        if($sqlite != 0){
        echo "SQLite Save <input type='checkbox' name='sqlite' value='1' checked='checked'/>";
          }
          else{
         echo "SQLite Save <input type='checkbox' name='sqlite' value='1'/>";
        }
    ?>           			      
		</div>
		
		<div>
		  <label class="vars-input" for="spellcheck" title=""><i class="fa fa-info-circle" ></i> Spellcheck enable/disable - (pow-config.php)</label><br>			 
 		<?php
        if($spellcheck != 0){
        echo "Spellchecker <input type='checkbox' name='spellcheck' value='1' checked='checked'/>";
          }
          else{
         echo "Spellchecker <input type='checkbox' name='spellcheck' value='1'/>";
        }
    ?>           			      
		</div>			      	
    
   	<div>
		  <label class="vars-input" for="tooltip" title=""><i class="fa fa-info-circle" ></i> Tooltip enable/disable - (pow-config.php)</label><br>			
 		<?php
        if($tooltip != 0){
        echo "Tooltip <input type='checkbox' name='tooltip' value='1' checked='checked'/>";
          }
          else{
         echo "Tooltip <input type='checkbox' name='tooltip' value='1'/>";
        }
    ?>           			      
		</div>	
		
		<div>
		  <label class="vars-input" for="editor" title=""><i class="fa fa-info-circle" ></i> HTML Editor - (No Option Yet) (pow-config.php)</label><br>
			<input id="pass" name="editor" class="element" type="text" maxlength="255" size="32" value="<?php echo "pow-tinymce-inc.php" ;?>"/> 			      
		</div> 		
    
    <h4>FTP Settings</h4>    
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> FTP Host IP - (pow-config.php)</label><br>
			<input id="ftp_host" name="ftp_host" class="element" type="text" maxlength="255" size="32" value="<?php echo $ftp_host ;?>"/> 			      
		</div>
		
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> FTP Username - (pow-config.php)</label><br>
			<input id="ftp_user" name="ftp_user" class="element" type="text" maxlength="255" size="32" value="<?php echo $ftp_user ;?>"/> 			      
		</div>

		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> FTP Password - (pow-config.php)</label><br>
			<input id="ftp_pass" name="ftp_pass" class="element" type="text" maxlength="255" size="32" value="<?php echo $ftp_pass ;?>"/> 			      
		</div>
		
		<div>
		<label class="vars-input" for="lang_code" title=""><i class="fa fa-info-circle" ></i> Language Code - (pow-config.php)</label><br>
      <select name="lang_code" id="language">
        <option value="en">Select Language + code</option>
        <option value="custom">Custom</option>
        <option value="en">English - en</option>
        <option value="de">German - de</option>
        <option value="fr">French - fr</option>
        <option value="ru">Russian - ru</option>
        <option value="se">Swedish - sv</option>
        <option value="zh">Chinese - zh</option>
      </select>		
		</div>
		 <br>
    <input id="saveForm" class="button" type="submit" name="submit_system" value=" Update System Settings " />     

		</form>			

</div> <!-- end system setting column -->

<div style="display: inline; position: absolute; left: 830px; top: 90px; ">

  <h4>Translate POW CMS </h4>


<?php
     echo "Language code: ".$lang_code ;
     echo "<br>Status: ". language_status ;
?>

		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Language Code - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "en" ;?>"/><?php echo $test ;?>      		
      <input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo lang_code ;?>"/>
		</div> 
		
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> Language Name - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "English" ;?>"/> 			
      <input id="title" name="language" class="element" type="text" maxlength="255" size="32" value="<?php echo language ;?>"/>
		</div> 		
    
		<div>
		  <label class="vars-input" for="name" title=""><i class="fa fa-info-circle" ></i> POW CMS Translator - (pow-vars.js)</label><br>
			<input id="title" name="title" class="element" type="text" maxlength="255" size="32" value="<?php echo "Translator Name" ;?>"/> 			
      <input id="title" name="Translator_Name" class="element" type="text" maxlength="255" size="32" value="<?php echo Translator_Name ;?>"/>
		</div>
</div> <!-- end translations column --> 
 
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

jQuery.colorbox({width:"550px", height:"350px",html:'<div class="modal-body"><h4>Scanning Folders and Updating Files!</h4><ul><li>This will take a couple of seconds</li><li>Coyping files and updating folders</li><li>Scanning folders for Word Tags and descriptions</li><li>Writing file for Search function</li><li>Updating Search function</li><li>Writing Folder Lists Files</li><br><progress value="0" max="8" id="updateBar"></progress></ul></div>'});

            $('#cboxClose').remove();
            setTimeout(function(){
              $(window).colorbox.close();
            }, 7000)
            
$.ajax({ 
    url: "/pow-update.php",
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

  <!-- Bootstrap Core JavaScript -->
<?php if(file_exists($root.'res/bootstrap/bootstrap.min.js')) { ;?>  
    <script src="/res/bootstrap/bootstrap.min.js"></script>  
  <?php } else { ;?> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<?php } ;?>

</body>
</html> 