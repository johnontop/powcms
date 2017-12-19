echo off
SET NewDir=pow-new
ECHO .
ECHO THIS BAT FILE WILL CREATE A NEW POW Mini DIRECTORY 
ECHO AND COPY ONLY NEEDED SYSTEM FILES TO IT.
ECHO .
ECHO Remember to Logout from current POWCMS and Clear Cache in new Copy.
ECHO .
set /P NewDir="ENTER NEW DIRECTORY HERE > " ||set NewDir=pow-new
SET CurrentDir=%CD%
CD %CD% 

MD ..\%NewDir%
XCOPY .\*.* ..\%NewDir%\*.*

XCOPY res\*.* ..\%NewDir%\res\
XCOPY res\colorbox\*.* ..\%NewDir%\res\colorbox\ /S 
XCOPY res\datetime\*.* ..\%NewDir%\res\datetime\ /S 
XCOPY res\side-menu\*.* ..\%NewDir%\res\side-menu\ /S 
XCOPY res\tipuesearch\*.* ..\%NewDir%\res\tipuesearch\ /S
XCOPY res\tipuesearch\*.* ..\%NewDir%\res\filemanager\ /S  
 
XCOPY theme\*.* ..\%NewDir%\theme\ /S
XCOPY system\*.* ..\%NewDir%\system\ /S 
COPY index_vars_info.js "..\%NewDir%\index_vars.js"

CD ..\%NewDir%
REN index.htm index-full.htm
REN index-mini.htm index.htm
REN pow-config.php pow-config-full.php
REN pow-config-mini.php pow-config.php
REN pow_vars.js pow_vars-full.js
REN pow_vars-mini.js pow_vars.js
REN "theme\top-menu.htm" "theme\top-menu-full.htm"
REN "theme\top-menu-mini.htm" "theme\top-menu.htm"

DEL index.html
DEL theme\landing*.* /q
DEL theme\demo*.* /q
DEL theme\header-image.pdn /q
DEL theme\thumb*.* /q 

pause

start.exe
exit