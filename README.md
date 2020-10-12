# Product

Product Management with clean architecture

## Install dependencies

```bash
$ composer install
```

## Create database

```bash
$ docker-compose up -d
```

Login in database and run the "queries.sql" file.

## Run API

```bash
$ cd public
$ php -S localhost:1200
```

Open localhost:1200 in the browser.


## Run tests

```bash
$ ./vendor/bin/phpunit --testdox
```
