# moment5-back
Used by frontend: https://github.com/axelhellberg/moment5-front

Published: http://axelhellberg.se/moment5/

Requests are handled in api.php (GET, POST, DELETE, PUT) as well as CORS and additonal headers. Requests use php input stream and request variables to run class functions.

Database connection made in classes/Course.class.php by class constructor. Class contains functions for SQL-queries made through prepared statements with PDO.

Database variables and automatic class loading specified in config.php.

URL's made prettier by .htaccess
