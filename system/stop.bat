@echo off
rem Killing process shttpd.exe and php-cgi.exe
taskkill /f /im shttpd.exe
taskkill /f /im php-cgi.exe

exit