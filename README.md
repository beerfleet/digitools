## This is a non profit exercise from the VDAB to practice Scrum in a small team

INSTALLEER COMPOSER

1.	Zie https://getcomposer.org/doc/00-intro.md#installation-windows

2.	Indien composer geïnstalleerd is, maar niet uitvoerd vanuit de command line:
 moet de lijn (;C:\ProgramData\ComposerSetup\bin;) toegevoegd worden aan de Windows path systeemvariabele, en nadien de pc heropgestart worden.

INSTALLATIE DB + SOURCE FILES
1.	Gebruik PHP 5.5 (XAMPP ) ps je kan perfect meerdere versies tegelijk van Apache en Mysql geïnstalleerd hebben (http://netcologne.dl.sourceforge.net/project/xampp/XAMPP%20Windows/5.5.19/xampp-win32-5.5.19-0-VC11-installer.exe)

2.	Open php.ini en zorg voor de volgende regels onder de sectie [XDebug] (bijschrijven of uit commentariëren)

xdebug.remote_enable = 0

xdebug.remote_handler = "dbgp"

xdebug.remote_host = "127.0.0.1"

3.	Herstart Apache

4.	Importeer met phpmyadmin of een client de .SQL whisky DB file.

5.	Stel het root paswoord in (deze is initieel by default leeg) + Maak aparte, NIET ROOT gebruiker aan met paswoord voor gebruik door de applicatie, en geef  deze toestemming tot alle CRUD operaties op de whisky DB

6.	Maak een map aan voor het project onder de htdocs folder ONDER DE JUISTE XAMPP INSTALLATIE.

7.	Ga via de CMD naar de hierboven gemaakte map (scrum in mijn geval)

8.	Geen via de CMD volgende commando: git init
Je krijgt de volgende bevestiging:
Initialized empty Git repository in C:/xampp_5.5.19/htdocs/scrum/.git/

9.	Geef vervolgens via CMD: git remote add origin  https://github.com/JeffVDAB/ScrumWhisky.git

10.	Git pull origin master

11.	Nu zouden de source files lokaal aanwezig moeten zijn, onder de aangemaakte folder

VOEG VIA COMPOSER DE BENODIGDE LIBRARIES IN.

1.	Open met CMD de hierboven aangemaakte folder

2.	Geef commando: "C:\ProgramData\ComposerSetup\bin\composer.bat" "--ansi" "--no-interaction" "update" "--no-dev" (indien composer.bat zich in de installatie default map bevindt)

!!! documentatie externe libs:

// Validatie library
Valitron : http://vancelucas.com/blog/valitron-the-simple-validation-library-that-doesnt-suck/

// Routing framework
Slim: http://docs.slimframework.com/

EXTRAS:
 zie extra.md