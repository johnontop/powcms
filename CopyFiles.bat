REM @echo off
REM - WARNING  - index.htm, powedit.php, side-links.htm. side-pages.htm, info.htm and info.htm will be copied to ALL sub folders
REM - Press Ctrl-C to abort

REM - Remove file "thumbs.db" in ALL sub folders
ATTRIB -R +A -S -H .\*.* /S /D
DEL thumbs.db /S    

for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "index.htm" "%%F" 



for /f "delims=" %%F in (
  'dir /ad /s /b ".\pages\" ^| findstr /virc:"git[^\\]*$"'
) do copy "index.htm" "%%F"  


for /f "delims=" %%F in (
  'dir /ad /s /b ".\sysinfo\" ^| findstr /virc:"git[^\\]*$"'
) do copy "index.htm" "%%F" 



for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "side-pages.htm" "%%F"

for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "side-links.htm" "%%F"

for /f "delims=" %%F in (
  'dir /ad /s /b ".\" ^| findstr /virc:"git[^\\]*$"'
) do copy "info.htm" "%%F"

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