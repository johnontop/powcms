echo off
SET NewDir=pow-new
ECHO .
ECHO THIS BAT FILE WILL CREATE A NEW POW Mini DIRECTORY 
ECHO AND COPY ONLY NEEDED SYSTEM FILES TO IT.
ECHO .
ECHO Remember to Logout from current POWCMS and Clear Cache in new Copy.
ECHO .
ECHO Create a POWCMS named pow-mini or enter your own name:
ECHO .
set /P NewDir="USE PREDEFINED NAME OR ENTER NEW DIRECTORY NAME HERE > " ||set NewDir=pow-mini
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
XCOPY sysinfo\*.* ..\%NewDir%\sysinfo\
COPY index_vars_info.js "..\%NewDir%\index_vars.js"

CD ..\%NewDir%

REN index.htm index-full.htm
REN index-cdn.htm index.htm
REN search.htm search-full.htm
REN search-cdn.htm search.htm
REN pow-config.php pow-config-full.php
REN pow-config-mini.php pow-config.php
REN pow_vars.js pow_vars-full.js
REN pow_vars-mini.js pow_vars.js

DEL index.html
DEL theme\landing*.* /q
DEL theme\demo*.* /q
DEL theme\header-image.pdn /q
DEL theme\thumb*.* /q 

CD theme
RENAME "top-menu.htm" "top-menu-full.htm"
RENAME "top-menu-mini.htm" "top-menu.htm"

cd ..
start.exe
exit