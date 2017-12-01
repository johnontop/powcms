@echo off
echo Killing process
taskkill /f /im shttpd.exe
taskkill /f /im php-cgi.exe


for %%* in (.) do set CurrDirName=%%~nx*
echo Folder Name
echo %CurrDirName%

SET CurrentDir=%CD%
CD %CD% 
echo %CurrentDir%

echo Create Desktop Icon for Windows XP
FOR /F "usebackq tokens=3 skip=4" %%i in (`REG QUERY "HKCU\Software\Microsoft\Windows\CurrentVersion\Explorer\User Shell Folders" /v Desktop`) DO SET DESKTOPDIR=%%i
FOR /F "usebackq delims=" %%i in (`ECHO %DESKTOPDIR%`) DO SET DESKTOPDIR=%%i
ECHO %DESKTOPDIR%
shortcut.exe /f:"%DESKTOPDIR%\%CurrDirName%.lnk" /i:"%CD%\theme\favicon.ico" /a:c /w:%CD% /t:^%CD%^%\start.exe  

echo Create Desktop Icon for Windows 7 8 10 
FOR /F "skip=2 tokens=3* delims= " %%a in ('reg query "HKEY_CURRENT_USER\Software\Microsoft\Windows\CurrentVersion\Explorer\User Shell Folders" /v Desktop') do set DesktopFolder=%%a
FOR /F "usebackq delims=" %%i in (`ECHO %DesktopFolder%`) DO SET DesktopFolder=%%i
shortcut.exe /f:"%DesktopFolder%\%CurrDirName%.lnk" /i:"%CD%\theme\favicon.ico" /a:c /w:%CD% /t:^%CD%^%\start.exe  

echo %DesktopFolder%

  IF EXIST %CD%\system\shttpd.exe (
        cd system
        echo .
        echo Starting POW CMS with PHP v5.4.9
        start shttpd.exe
        start.htm
        
    ) ELSE (
        echo .
        echo "Starting POW CMS"
        start shttpd.exe        
        start.htm
    )
exit