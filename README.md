# Small Blog

Project blog small resource

## Installation

```bash
composer install
```

## Running Local Server in terminal/cmd

```bash
php -S 127.0.0.1:8000

```

## Import Database Mysql
Import small_blog.sql to your database, then change configuration .env

## htaccess file must exist
.htaccess file must exist when deployment to website


## Information Login Admin
username: admin

password: operation12

## Create Password For Admin
```php
<?php password_hash("passwordyou", PASSWORD_DEFAULT) ?>
```
