@ECHO OFF
ECHO Starting PHP FastCGI...
set PATH=D:\xampp\php;%PATH%
c:\bin\RunHiddenConsole.exe D:\xampp\php\php-cgi.exe -b 127.0.0.1:9000