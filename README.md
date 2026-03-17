<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px" alt="">
    </a>
    <h1 align="center">Займы</h1>
    <br />
</p>

Установка
------------

Склонируйте репозиторий

    git clone https://github.com/KewaPopug/loans.git

Перейдите в директорию

    cd loans


Конфигурация
-------------

### БД

Создайте файл `config/db.php` с данными, к примеру:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=postgres;dbname=loans',
    'username' => 'user',
    'password' => 'password',
    'charset' => 'utf8',
];
```
### Cookie validation key

Создайте `config/params.php`.
Установите cookie validation key `config/params.php` с случайной строкой:

```php
return [
    'cookieValidationKey' => '<secret random string goes here>',
]
```

DOCKER
-------------

Обновите пакеты

    docker-compose run --rm php composer update --prefer-dist

Запустите триггеры установки (создайте код проверки cookie).

    docker-compose run --rm php composer install    

Запуститe контейнер

    docker-compose up -d

Мигрируйте базу данных

    docker-compose exec php php yii migrate

Затем вы сможете получить доступ к приложению по следующему URL-адресу:

    http://localhost:80

