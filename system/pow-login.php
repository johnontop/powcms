<?php
ini_set('display_errors', '0');

define("ROOT", __DIR__ ."/");
setcookie('root', ROOT, time()+60*60*24*365 ); 

/* These are our valid username and passwords */
include 'pow-config.php' ;
$msg = 'Please enter a username and password.';

  if (isset($_POST['logout'])) {
            /* Cookie expires when browser closes */
            //setcookie('username', $_POST['username'], '');
            //setcookie('password', md5($_POST['password']), '');
            setcookie("username", '',time() - 3600);
            setcookie("password", '',time() - 3600);
            setcookie("root", '',time() - 3600);
            setcookie('login_status','Logged Out', time()+60*60*24*365 );
            header('Location: index.htm');
        }

  if (isset($_POST['login'])) {
  if (isset($_POST['username']) && isset($_POST['password'])) {
    
    if (($_POST['username'] == $user) && ($_POST['password'] == $pass)) {    
        
        //if (isset($_POST['submit'])) {
            /* Set cookie to last 1 year */
            setcookie('username', $_POST['username'], time()+60*60*24*365 );
            setcookie('password', sha1($_POST['password']), time()+60*60*24*365 );
            setcookie('login_status','Logged In', time()+60*60*24*365 );
            //header('Location: login-check.php');
            header('Location: pow-edit.php');
        //  }
       }    
        else {
         $msg = 'Username/Password Invalid';
        }  
       // header('Location: login-check.php');
        
    } else {
        
       $msg = 'Please enter username and password.';
    }
  } 
/*    
 else {
    echo 'You must supply a username and password.';
    }
*/ 
 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8; encoding=utf-8"  >
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title id="title">Index</title>  

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
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins and reading files via index_vars.js) -->    
<?php if(file_exists($root.'res/js/jquery.min.js')) { ;?>  
    <script src="/res/js/jquery.min.js"></script>
  <?php } else { ;?> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<?php } ;?>    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>   
    <![endif]-->                                                       
    
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
          <a class="navbar-brand" href="/"><img src="/theme/topbar-logo.png" /></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
        <div id="textMenuID"></div> 
        </div><!--/.nav-collapse -->
      </div>
    </nav>  


<div class="container page-bg">

   <div class="row">
    <div class="col-md-9">  
      <img class="header-image" src="/theme/header-image.png" >
      <p class="header-title"><var>system_title</var></p>   
    </div> <!-- .col-md-9 -->

    <div class="col-md-3">       
      <div class="status"> 
      Title: Login
      <br />
      Page : login.php
      <br />
      Data ID : login page
      <br />
      Category : System
      <br />
        
      </div>    
    </div> <!-- .col-md-3 -->
  </div> <!-- .row -->
  <hr>



<div class="col-md-12">
  <div class="row">

    <div class="col-md-9">
      <div class="text-position">  
      <h2>POW CMS Editor Login</h2>
  
      
  <h3>Status: <?php echo $_COOKIE['login_status'] ;?></h2>
  <h4><?php echo $msg ;?></h4>
  <form name="login" method="post" action="pow-login.php">
  
   <p>Username: <input type="text" name="username"></p>
   <p>Password: <input type="password" name="password"></p>
   <br>
   <input type="submit" name="login" value="Login">&nbsp; 
   <input type="submit" name="logout" value="Logout">&nbsp;   
   <input type="button" onclick="location.href='/index.htm';" value="Start Page" />
  </form>
       <?php if(isset($_COOKIE['login_status']) && $_COOKIE['login_status']== 'Logged In' ) { ?>
       <br>
       <?php echo $sqlite_msg ;?>
       <br>
      <a href="system/php-info.php">View PHP-Info</a>    
       <br>
       <?php } ?> 
      </div> <!-- /.text-position -->     
    </div> <!-- .col-md-9 -->

    <div class="col-md-3">  
      <div class="side-menu">
      <h4 class="side-menu-title">Pages</h4>                        
      <div id="textFolderID"></div>
      <div id="textPagesID"></div>
      <h4 class="side-menu-title">Links</h4>
      <div id="textLinksID"></div>
      </div>
    </div> <!-- .col-md-3 -->
     
  </div> <!-- .row -->
</div> <!-- .col-md-12 -->

</div> <!-- /.container -->  
       
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

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="/res/bootstrap/bootstrap.min.js"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  -->
    
    <!-- <script src="js/bootstrap.min.js"></script>  -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>  -->
  
  </body>
</html>