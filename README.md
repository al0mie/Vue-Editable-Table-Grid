# Silex Simple REST and vue data table components

#### How do I run it?
After download from the root folder of the project, run the following commands to install the php dependencies, import some data, and run a local php server.

You need at least php **7.0*** with **mysql extension** enabled and **Composer**
    
    composer install 
    php -S 0:9001 -t web/

    
Your api is now available at http://localhost:9001/v1.

To config database, go to config/prod.php

```php
$app['db.options'] = array(
  'driver' => 'pdo_mysql',
  'user' => 'user',
  'password' => 'password',
  'dbname' => 'mydb',
  'host' => 'localhost',
);
```

#### Run tests

`vendor/bin/phpunit`


#### What you will get
The api routes

	GET  ->   http://localhost:9001/api/users
    GET  ->   http://localhost:9001/api/users/{id}
	POST ->   http://localhost:9001/api/users
	PATCH ->   http://localhost:9001/api/users/{id}
	DELETE -> http://localhost:9001/api/users/{id}
