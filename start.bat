@echo off
setlocal
cd /d "%~dp0"
where php >nul 2>nul
if errorlevel 1 if exist "C:\xampp\php\php.exe" set "PATH=C:\xampp\php;%PATH%"
where php >nul 2>nul
if errorlevel 1 (
    echo PHP was not found. See README.md for setup instructions.
    pause
    exit /b 1
)
if not exist vendor\autoload.php goto :setupneeded
if not exist .env goto :setupneeded
php artisan serve --host=127.0.0.1 --port=8000
if errorlevel 1 pause
exit /b
:setupneeded
echo Run setup.bat once before starting the server.
pause
exit /b 1
