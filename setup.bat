@echo off
setlocal
cd /d "%~dp0"
where php >nul 2>nul
if errorlevel 1 (
    if exist "C:\xampp\php\php.exe" (
        set "PATH=C:\xampp\php;%PATH%"
    ) else (
        echo PHP was not found. Install PHP 8.2 or later and add it to PATH.
        echo See README.md for Windows instructions.
        pause
        exit /b 1
    )
)
where composer >nul 2>nul
if errorlevel 1 (
    echo Composer was not found. Install Composer and reopen VS Code.
    echo Select your PHP executable in the Composer installer.
    pause
    exit /b 1
)
call composer install
if errorlevel 1 goto :failed
if not exist .env copy /y .env.example .env >nul
findstr /B /C:"APP_KEY=base64:" .env >nul
if errorlevel 1 (
    php artisan key:generate --ansi
    if errorlevel 1 goto :failed
)
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
if errorlevel 1 goto :failed
php artisan migrate --seed
if errorlevel 1 goto :failed
php artisan optimize:clear
if errorlevel 1 goto :failed
echo.
echo Setup complete. Run start.bat or type: php artisan serve
echo Open http://127.0.0.1:8000 in your browser.
pause
exit /b 0
:failed
echo.
echo Setup stopped. Read the error above and the troubleshooting in README.md.
pause
exit /b 1
