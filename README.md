<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px" alt="">
    </a>
    <h1 align="center">Loans</h1>
    <br />
</p>

INSTALLATION
------------

Clone the repository

    git clone https://github.com/KewaPopug/loans.git

Enter the project directory

    cd loans


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=postgres;dbname=loans',
    'username' => 'user',
    'password' => 'password',
    'charset' => 'utf8',
];
```
### Secret string

Set cookie validation key in `config/params.php` file to some random secret string:

```php
[
    'cookieValidationKey' => '<secret random string goes here>',
]
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
Migrate the database

    docker-compose exec php php yii migrate

You can then access the application through the following URL:

    http://localhost:80
