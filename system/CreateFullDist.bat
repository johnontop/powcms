@echo off
SET NewDir=pow-new
ECHO .
ECHO THIS BAT FILE WILL CREATE A NEW POWCMS DIRECTORY AND COPY ALL SYSTEM FILES TO IT.
ECHO .
ECHO Remember to Logout from current POWCMS and Clear Cache in new Copy.
ECHO .
set /P NewDir="ENTER NEW DIRECTORY HERE > " ||set NewDir=pow-new
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