@echo off
for /f "delims=" %%a in ('dir /ad /b /s^|sort /r') do (
pushd "%%a"
dir /a-d /b /s 2>nul 1>nul||(
cd ..
echo ' ' >> %%a/index.html
)
popd
)
pause