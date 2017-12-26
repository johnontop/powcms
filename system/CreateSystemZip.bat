echo off
ECHO .
ECHO THIS BAT FILE WILL CREATE A ZIP FILE 
ECHO AND COPY ALL FILES AND FOLDERS TO IT.
ECHO .
for %%* in (.) do set CurrDirName=%%~nx*
ECHO PREDEFINED NAME = %CurrDirName%
ECHO .
set /P NewDir="USE PREDEFINED NAME OR ENTER NEW ZIP NAME HERE > " ||set NewDir=%CurrDirName%
DEL %NewDir%.zip
SET CurrentDir=%CD%
CD %CD% 
SET CurrentDir=%CD%
".\res\7-Zip\7z.exe" a -r %CurrentDir%\%NewDir%.zip -w *.* -mem=AES256