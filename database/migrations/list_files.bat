@echo off
setlocal enabledelayedexpansion

:: Get the current directory
set "folder=%~dp0"

:: Output file name
set "outputFile=%folder%file_list.txt"

:: Clear the output file if it exists
if exist "!outputFile!" del "!outputFile!"

:: Iterate through all files (excluding directories) in the current folder
for %%f in ("%folder%*") do (
    if not exist "%%f\" (
        echo %%~nxf>>"!outputFile!"
    )
)

echo File list written to !outputFile!
pause
