# test_proj

This is a testing project with which it using CI framewrok with 2.1.4. It contains a signup and login page which uses CSRF and 
XSS protection at CI side. It also has a basic RESTFUL API implemented with security in mind. This is test project also has a 
Memcache module with which when used greatly improves the performance the system.

# Installation

1) Download the latest version of this test project by clicking "Download as Zip" and extract it on your web accessible directory
or just clone this repository.

2) Create your database.

3) Set the apps database configuration by going to application/config/database.php file. Set all the necessary things needed 
to connect to your database.

4) Open file application/config/migration.php and set the below to TRUE.

      $config['migration_enabled'] = TRUE;
      
5) On the browser, open http://< website >/install or if you're working locally then http://localhost/test_proj/install

6) After it has successfully installed, Open again the file application/config/migration.php and set it to FALSE;

      $config['migration_enabled'] = FALSE;
      
      
# Memcache

If you want the app to use Memcache, you need it installed on your machine or wherever machine the app resides. For
more details on the installation please visit <a href="http://php.net/memcached>http://php.net/memcached</a>

After you've installed Memcache open file

    application/config/memcached.php
  
On that file you put there all the necessary settings to connect to your Memcache server. After setting it open the file

    application/config/constants.php
    
and set the following to TRUE

    define('MEMCACHE', FALSE);
    
that is FALSE by default.

... and that's it!


# RESTful API

After you've created an account on that test project and logged in, you can see some basic instructions on how to use the API.
    
      
