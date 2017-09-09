    VARS = {};
    VARS.title = "Portable Offline Web CMS ";
    VARS.name = "Portable Offline Web CMS ";
    VARS.file_name = "readme.htm";
    VARS.data = "page-info";
    VARS.category = "Root";
    VARS.date = "2017-09-08 20:15";
    VARS.image = "theme/header-image.png";
    VARS.tags = "Portable Offline Distributable CMS Root";
    VARS.description = "The Portable 'Offline' Web CMS (POW CMS) is a very easy way to build and view an offline web site.  The goal with this project is to make a complete, simple and tiny html file based CMS and web server system that is portable on a USB stick and requires no installation.";
                
        $.ajax({            
            url : "readme.htm",
            type: "GET",
            dataType: "text",
            isLocale: true,
            success: function(data) {
            $("#textFileID").html(data); }}); 
         
    // Get Image for page           
            $(function() {
            $("#image_load").append("<img src=theme/header-image.png>"); });               
            
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
            