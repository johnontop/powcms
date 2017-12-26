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
            <li><a href="/index.htm"><?php echo Start ;?> - <?php echo basename(__DIR__) ;?></a></li>                                                                           
            <li><a href="/search.htm"><?php echo Search ;?></a></li>                                                 
            <li><a href="/res/filemanager/" target="_blank"><i class="fa fa-files-o" ></i> <?php echo File_Manager ;?></a></li>                                                                                                  
            <li><a href="/pow-view.php" target="_blank"><i class="fa fa-search" ></i> <?php echo Content ;?></a></li>
            <li><a href="/system/updater"><i class="fa fa-download" ></i> <?php echo Updater ;?></a></li> 
            <li><div class="clock"></div></li>                                    
          </ul>          
          
         <ul class="nav navbar-nav">                                               
            <li><a title="Change System Username & Password, Web Title - Enable/Disable functions. Translations not fully functional yet. " href="/pow-custom.php"><i class="fa fa-cog" ></i> <?php echo Customize ;?></a></li>         
            <li><a href="/pow-scan.php" title="Update the search function with the tags and description you have written. View Tags per Page." ><i class="fa fa-folder-open" ></i> <?php echo Folder_Scan ;?></a></li>
            <li><a href="#" id="confirm" onclick="call_popup(); return false;" title="If you have created new sub folder this function  will copy needed files to the folders, so you can edit text file in folder." ><i class="fa fa-refresh" ></i> <?php echo System_Update ;?></a></li>
         
            <li><a href="/pow-login.php"><i class="fa fa-key" ></i> <?php echo Logout ;?></a></li>             
            <li><a href="javascript:history.go(-1)" title="Tooltip - "><i class="fa fa-arrow-circle-left" ></i> <?php echo Back ;?></a></li>               
        </ul>                  
        </div><!--/.nav-collapse -->
      </div>
    </nav>
