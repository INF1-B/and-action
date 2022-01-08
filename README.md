# And-action - General
Movieplatform And Action is a web platform that is used by directors, actors and normal users that just want to watch a movie.
The platform was requested by 2 clients of the Sunhines from NHL Stenden.

## Software
In order to run the webplatform, the following software requirements are needed. Note that alternatives might work aswell, but have not been tested.

### Windows
* XAMPP : 8.0.0
  * XAMPP will hold the following software
    * PHP : 8.0.0
    * MariaDB : 10.4.17 
    * Apache2 : 2.4.46
    * Phpmyadmin : 5.0.4
 
### Linux
* Apache2 : 2.4.41
* MariaDB : 10.4.17 
* PHP: 8.0.0

Furthermore a web browser, like Google Chrome or Firefox is needed to display the web content.

## Hardware
The following hardware requirements are needed to run the web application

Low end laptop or pc with *atleast* the following specifications:
 * A i3 processor or higher (lower might work, but is not recommended)
 * 4GB of RAM
 * 20GB of free disk space

# Windows Installation - step by step
In order to install the web application succesfully on a windows pc/laptop, please follow the following steps:

1. Go to the following [link](https://www.apachefriends.org/index.html) and install XAMPP.
2. After installation, open the XAMPP control panel and click on 'start' next to 'apache'. Apache2 should by default start on port 80 and 443. We will be using port 80 for the webserver.
3. In the Xampp control panel, Start MySQL and click on admin, this will lead you to the [phpmyadmin](https://localhost:80/phpmyadmin) console.
4. From your terminal, clone the repository: https://github.com/INF1-B/and-action to your ```C:/xampp/htdocs``` folder. You can clone the repository by first navigating to ```c:/xampp/htdocs``` in your terminal, and then execute the following command 

``` git clone https://github.com/INF1-B/and-action -b main ```

6. After cloning the repository, we have to search for the database file which can be found in ```/src/database/export/and_action_windows.sql```
7. After finding the file ```and_action_windows.sql``` go to [phpmyadmin](https://localhost:80/phpmyadmin) and authenticate yourself.
8. Afer authenticating at [phpmyadmin](https://localhost:80/phpmyadmin), go to the 'new/nieuw' tab (to create a new database)

![image](https://user-images.githubusercontent.com/89914058/148645966-d9600e03-8f84-424c-a3e1-8b9323c553e1.png)

9. After clicking on the "new/nieuw" tab, click on "import"

![image](https://user-images.githubusercontent.com/89914058/148646023-1b8e08d3-4d68-4677-ae68-bdfb228ef9b5.png)


10. click on 'choose file' and import the ```and_action_windows.sql``` database file. Finally click on "GO/start". Your database should be ready to use now!
11. As a final step, go to your webbrowser of choice and navigate to the following url http://localhost/and-action/public/index.php. 

You should be all set to use the application now!






