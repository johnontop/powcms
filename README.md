# powcms
Portable Offline Web CMS

What is Portable Offline Web CMS?

The Portable Offline Web CMS (POW CMS) is a very easy way to build and view an offline web site.
The goal with this project is to make a complete, simple and tiny html file based CMS and web server system that is portable on a USB stick and requires no installation. The project is more focused on making of web pages as easy as possible, compared to a complex online web server system. This package might be perfect for you - if you need a whole working web site for distribution - on a USB stick or by downloads, - if you write texts for the web, make web designs, make presentations anywhere

- It is an entirely file based CMS system.
- Fully functional web site, based on only HTML pages.
- No external dependencies.
- Requires no internet connection.
- No installation required. Just unzip and run start.bat file
- It is responsive with Bootstrap framework and jQuery.
- Built in PHP support for "Edit mode".
- HTML editor for editing local html files.
- Support for portable MySQL or SQLite for more advanced functions.

Portable Offline Web System is perfect for:
- Runs from a USB stick, no need for internet connection.
- Show an offline version of your website
- Anywhere and anytime develop html/php websites
- No need for expensive hosting
- Working at multiple locations at projects
- A good test before putting your website online
- And many more advantages.

With this package you get:
- Portable Offline Web Server, shttpd.exe(60KB) powered with PHP v4.5.9 for Window 32-bit.
- Bootstrap responsive framwork version 3.3.7
- Support for SQLite and MySQL 5.0.67 Portable.
- Fast jQuery based search function
- TinyMCE HTML editor for editing local files with web pages.
- Simple, unsafe cookie based login function for the editor function. (user=admin / password=password)
- Web Site Index generator (under development).
- Bootstrap templates for easy change of page apperance (under development)

Get started with Portable Offline Web Server

Download the POWCMS zip file, unzip it and ...

Click on start.bat in the "root" folder to run the web server and start the web pages.

Click on start.bat in the "system" folder to run the web server and start the web pages in "Page Edit" mode with PHP enabled.

You can browse the site index.htm directly with Firefox, but Chrome prohibits loading files via javascript.

How the Portable Offline Web Server works

Resources - files

Each folder contains these files.
- index.htm (main page template. This is a copy of index.htm in the root folder.)
- index_vars.js (file with variables that is read by index.htm)
- side-pages.htm (list with home and back links, shown in right column)
- side-folders.htm (list with folders/pages, shown in right column)
- side-links.htm (list with web links, shown in right column)
- info.htm (place holder file with info on how to get started - rename this file to your file name)
- pow-edit.php (the page editor for your html file that is specified in file "index_vars.js")
- pow-vars.php (the variable editor for the variables that are specified in file "index_vars.js") (this code will be integrated into "pow-edit.php" and pow-scan.php" later, when the UTF-8 file write/read issues is sorterd out. Pow-vars.php also creates a file "search_vars.txt" that will be used for the search function.

index_vars.js - file in each folder

The main page file "index.htm" reads the file "index_vars.js" that contains variables that are used by "index.htm" to show a complete web page and enable the search function.
"index_vars.js" also reads the 3 default side files, shown in right column. The main variables are shown in the upper right corner of pages. This section is removed/hidden when the /system folder is deleted before making a distribution zip file. The variables are:

VARS.title = "Portable Offline Web Page"; (Page name, also used as H1 tag in "index.htm")
VARS.file_name = "start.htm"; (File name with html text that is read by index.htm)
VARS.data = "page-start"; (Data ID, that can be used as page identifier)
VARS.category = "Category"; (Category, for any purpose)
VARS.tags = "Tag names"; (Tags for the search function)
VARS.description = "Description text"; (Description text for the search function presentation)
Page Templates Copy

The file "index.htm" in the root folder is the starting point to all web pages.
The Menu files named "side-pages".htm, "side-folders.htm", "side-links.htm", make up the menu in the right side column.
Edit these files as you want them, the run the BAT file "CopyFiles.bat" in the root folder and the files will be copies to ALL sub folders.
About the "shttpd.exe" web server

The web server "shttpd.exe" is a really small single file server, only 60KB in size.
When clicked on it will start and go to systray. There is where you can shutdown and exit. Configuration is done in the file "shttpd.conf"
Index Page launch order

The page launch order is specified in the file "shttpd.conf".
The order is index.php, index.html and index.htm.
This means that - if a page named index.html exist in a folder, it will be launched before index.htm.
