REM @echo off
REM - index.htm, powedit.php will be copied to ALL sub folders
REM - Press Ctrl-C to abort

SET CurrentDir=%CD%
CD %CD% 

REM - Remove file "thumbs.db" in ALL sub folders
ATTRIB -R +A -S -H .\*.* /S /D
DEL thumbs.db /S

for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "index.htm" "%%F"

for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "pow-edit.php" "%%F"


CD res
call CleanUpFiles.bat
CD ..\system
call CleanUpFiles.bat
CD ..\theme
call CleanUpFiles.bat

exit
