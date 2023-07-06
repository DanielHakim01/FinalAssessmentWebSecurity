### 6. File Security Principles

To prevent directory traversal to our most important files, we use .htaccess to avoid users accessing our database credentials stored in config.php

.htaccess file:

Options -Indexes
RewriteEngine On
RewriteRule ^(.*)$ index.php [L]

An error will be displayed if an user tries to type in the directory of config.php

![image](https://github.com/DanielHakim01/FinalAssessmentWebSecurity/assets/47686304/e20d384e-229e-479a-9ecf-929c55038850)
