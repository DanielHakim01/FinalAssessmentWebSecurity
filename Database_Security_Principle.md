# 5. Database Security Principles

To secure our database, we omit the database credentials in each webpage that requires to call the information from the database. We put the credentials in config.php and call through that file instead.

config.php
------
    <?php
    $database_host = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'user_info';
    ?>
------

We write this line on top each time we want to access the database.

------
    require_once('../app/config.php');
------
