@echo off
SET NewDir=pow-new
ECHO .
ECHO THIS BAT FILE WILL CREATE A NEW POWCMS DIRECTORY 
ECHO AND COPY ONLY NEEDED SYSTEM FILES TO IT.
ECHO .
ECHO Remember to Logout from current POWCMS and Clear Cache in new Copy.
ECHO .
ECHO Create a POWCMS named pow-full or enter your own name:
ECHO .
set /P NewDir="USE PREDEFINED NAME OR ENTER NEW DIRECTORY NAME HERE > " ||set NewDir=pow-full
SET CurrentDir=%CD%
CD %CD% 

MD ..\%NewDir%
XCOPY .\*.* ..\%NewDir%\*.*

XCOPY res\*.* ..\%NewDir%\res\ /S 
XCOPY theme\*.* ..\%NewDir%\theme\ /S
XCOPY sysinfo\*.* ..\%NewDir%\sysinfo\ /S 
XCOPY templates\*.* ..\%NewDir%\templates\ /S  
XCOPY system\*.* ..\%NewDir%\system\ /S 
COPY index_vars_info.js "..\%NewDir%\index_vars.js"

CD ..\%NewDir%
start.exe
exit