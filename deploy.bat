@echo off
echo Deploying to Hostinger...
echo.
echo Step 1: Connecting to server...
echo Run this command in PowerShell:
echo.
echo ssh -p 65002 u588367702@147.93.14.134
echo.
echo Password: Altafhussainbirhmani376@
echo.
echo Step 2: After connecting, run this:
echo.
echo cd ~/domains/darkblue-echidna-104304.hostingersite.com/laravel ^&^& git pull origin main ^&^& php artisan optimize:clear ^&^& php artisan optimize
echo.
pause
