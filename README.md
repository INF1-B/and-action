# And-action
Movieplatform And Action is a platform that is used by directors, actors and normal users that just want to watch a movie.

# Requirements dev
## Software
In order to run the webplatform, the following software requirements are needed. Note that alternatives might work aswell, but have not been tested.

* XAMPP : 8.0.0
  * XAMPP will hold the following software
    * PHP : 8.0.0
    * MariaDB : 10.4.17 
    * Apache2 : 2.4.46
    * Phpmyadmin : 5.0.4

In order to run the application, all the files that are held in the main repository must be set in the C:\xampp\htdocs map after installation of xampp. 

## Hardware
The following hardware requirements are needed to run the web application

Low end laptop or pc with atleast:
 *An intel i3 processor
 *A graphic card

# Installation
1.Go to the following link: https://www.apachefriends.org/index.html and install XAMPP on a Windows computer.
2.Open XAMPP and click on 'start' next to 'apache'.
3.Start MySQL as well and click on admin, this will lead u to PHPMyAdmin.
4.Go to Github.com and clone the repository: https://github.com/INF1-B/and-action to ur c:/xampp/htdocs map.
5.Search for the 'and-action' map, and search for the database file which can be found in /src/database/export/and_action_windows.sql
6.Download the database file 'and_action_windows.sql' and go to PHPMyAdmin.
7.Go to 'Import', click on 'choose file' and import the 'and_action_windows.sql' database file. Make sure file character is set on UTF-8 and click on 'start' at the bottom of the page. The database is ready now!
8.Go to ur webbrowser and type in 'http://localhost/and-action-1/public/index.php' and now you're able to use the website!




