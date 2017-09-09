Portable Offline Web Server

The Portable Offline Web Server is a very simple way to build an offline web site.
It is responsive with Bootstrap framework and jQuery.
The goal with this project, is to make a complete, simple and tiny file based CMS and web server system, that is portable on a USB stick.
This package might be perfect for you - if you need a whole working web site on a USB stick, if you write texts for the web, make web designs, make presentations anywhere

With this package you get:
- Portable Offline Web Server (60KB) powered with PHP v4.5.9 for Window 32-bit.
- Support for SQLite and MySQL 5.0.67 Portable.
- Fully functional Web site.
- TinyMCE HTML editor for editing pages.
- Bootstrap templates for easy change of page apperance.
- Runs from a USB stick, no need for internet connection.
Get started with Portable Offline Web Server

Click on shttpd.exe to run the web server and then click on start.htm.

You can browser the site index.htm directly with Firefox, but Chrome prohibits loading files via javascript.
How the Portable Offline Web Server works
Resources - files
Each folder contains these files.
Index.htm (main page template. This is a copy of index.htm in the root folder.)
index_vars.js (file with variables that is read by index.htm)
side-pages.htm (list with home and back links, shown in right column)
side-folders.htm (list with folders/pages, shown in right column)
side-links.htm (list with web links, shown in right column)
info.htm (place holder file with info on how to edit "index_vars.js")
xxxxx.htm (your page text file that is specified in file index_vars.js)

index_vars.js - file

The "index.htm" file reads the file "index_vars.js" that contains variables that are used by "index.htm".
"index_vars.js" also reads the 3 default side files, shown in right column. The variables are shown in the upper right corner of pages. The variables are:

VARS.name = "Bootstrap Offline Web"; (Page name, also used as H1 tag in "index.htm")
VARS.data = "page-start"; (Data ID, that can be used as page identifier)
VARS.category = "Index"; (Category, for any purpose)
VARS.file_name = "start.htm"; (file name with html text that is read by index.htm)
About the "shttpd.exe" web server

The web server "shttpd.exe" is a really small single file server, only 60KB in size.
When clicked on it will start and go to systray. There is where you can shutdown and exit. Configuration is done in the file "shttpd.conf"

You can also download the single file Mongoose web server and save it to the root folder. Then run the Mongoose.exe file, set port to 80 and the web site can be viewed smoothly with a single click.
