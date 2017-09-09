What is Portable Offline Web CMS?

The POW CMS is in an early development stage, but is is fully functional.

The Portable Offline Web CMS (POW CMS) is a very easy way to build and view an offline web site.
The goal with this project is to make a complete, simple and tiny html file based CMS with a web server system that is portable on a USB stick and requires no installation or setup.
The project is more focused on making of web pages as easy as possible, compared to a complex online web server system. This package might be perfect for you - if you need a whole working web site for distribution - on a USB stick or by downloads, - if you write texts for the web, make web designs, make presentations anywhere. It is an entirely file based CMS system.

- Fully functional web site, based on only HTML pages.
- Folder and file based page system.
- No external dependencies.
- Requires no internet connection.
- No installation or setup required. Just unzip and run start.bat file
- It is responsive with Bootstrap framework and jQuery.
- Built in PHP support for "Edit mode" of the web pages.
- HTML editor TinyMCE is used for editing your local html files.
- Support for portable MySQL or SQLite for more advanced functions.

Portable Offline Web System is perfect for:
- Runs from a USB stick, no need for internet connection.
- Show an offline version of your website.
- Anywhere and anytime develop html/php websites.
- No need for expensive hosting.
- Working at multiple locations with pages and projects.
- A good test before putting your pages or website online.
- And many more advantages.

With this package you get:
- Portable Offline Web Server, shttpd.exe(60KB) powered with PHP v4.5.9 for Window 32-bit.
- Bootstrap responsive framework version 3.3.7
- Support for SQLite and MySQL 5.0.67 Portable.
- Fast jQuery v3.2.1 for fancy functions.
- TinyMCE HTML editor for editing local files with web pages.
- Tipue Search version 6.1 for fast page search.
- POW Scan, a folder tree viewer, that creates a page index for Tipue Search.
- POW Edit, a HTML web page editor and file variables editor
- Simple Tooltip function for info and hints. (info under development).
- Theme switcher, a simple function for changing page designs. (under development).
- Login a simple, unsafe cookie based login function for the editor function.
- Web site index generator for search (under development).
- Bootstrap templates for easy change of page apperance (under development)
- Limited documentation at the moment (under development)
Get started with Portable Offline Web CMS and Web Server

Download the POWCMS zip file, unzip it and ...

Click on start.bat in the "root" folder to run the web server and start the web pages. 

Login with (user=admin / password=password) and start editing pages.
How the Portable Offline Web Server works

Resources - files

Each folder contains these files.
- index.htm (main page template. This is a copy of index.htm in the root folder.)
- index_vars.js (file with variables that is read by index.htm)
- side-pages.htm (list with home and back links, shown in right column)
- side-folders.htm (list with folders/pages, shown in right column)
- side-links.htm (list with web links, shown in right column)
- info.htm (place holder file with info on how to get started - rename this file to your file name and specify your file name in the Page Editor)

- pow-edit.php (Web Page Editor for your html file that is specified in file "index_vars.js". It is also the editor for the variables that are specified in file "index_vars.js") pow-edit.php also creates a file "search_vars.txt" that will be used for the search function and the side-folder.htm for foder listing in the side column.

- pow-scan.php (Scans the folders for the files "search_vars.txt" and creates the file "search_content.js" that is used by Tipue Search to search the pages.
index_vars.js - file in each folder

The main page file "index.htm" reads the file "index_vars.js" that contains variables that are used by "index.htm" to show a complete web page and enable the search function.
"index_vars.js" also reads the 3 default side files, shown in right column. The main variables are shown in the upper right corner of pages. This section is removed/hidden when the /system folder is deleted before making a distribution zip file. The variables are:

VARS.title= "Portable Offline Web Page"; (Page name, also used as H1 tag in "index.htm")
VARS.file_name = "start.htm"; (File name with html text that is read by index.htm)
VARS.data = "page-start"; (Data ID, that can be used as page identifier)
VARS.date = "2017-09-10 20:21"; (Date and time that will be used for timestamps)
VARS.category = "Category"; (Category, for any purpose)
VARS.tags = "Tag names"; (Tags for a simple word search function)
VARS.description = "Description text"; (Description text for the search function presentation)
Page Templates Copy

The file "index.htm" in the root folder is the starting point to all web pages. "index.htm" reads the variables specified in the file "index_vars.js" and opens the files specified.
The Menu files named "side-pages".htm, "side-folders.htm", "side-links.htm", make up the menu in the right side column.
Edit these files as you want them, the run the BAT file "CopyFiles.bat" in the root folder and the files will be copies to ALL sub folders. The file "side-folders.htm" will be created by the Page Editor each time is started. After having created your sub folders in the /pages folder, just run BAT file "CopyFiles.bat" in the root folder to populate your folders with needed files. You can also do this from within the Page Editors top menu.
About the "shttpd.exe" web server

The web server "shttpd.exe" is a really small single file server, only 60KB in size.
When clicked on it will start and go to systray. There is where you can shutdown and exit. Configuration is done in the file "shttpd.conf". It is already configured for a relative "root" folder and PHP support
Index Page launch order

The page launch order is specified in the file "shttpd.conf".
The order is index.php, index.html and index.htm.
This means that - if a page named index.html exist in a folder, it will be launched before index.htm and if a file named index.php, that file will be laucnhed first.
The "Landing page" is therefor named index.html
