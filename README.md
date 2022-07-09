### ТЗ тестовой работы
    ИП Ельмикеев Евгений Иванович ( data-sfera )
    https://analyti.ru/

### стек разработки
    docker + docker-compose + nginx + php-fpm + postgres + pgadmin

### предустановленные пакеты
    nginx
    postgres (PostgreSQL) 14.3 (Debian 14.3-1.pgdg110+1)
    pgadmin
    php v8.1.6
    imagick 3.7.0
    xdebug 3.1.4

---
### установка проекта
* docker-compose up -d --build
* docker exec -it php-fpm /bin/bash

---
### необходимые конфигурации проекта Laravel 9.x
* composer create-project --prefer-dist laravel/laravel server
* php artisan migrate

---
### комментарии по ТЗ
* в ТЗ не указано, но по идее нужно было реализовать аутентификацию и авторизацию
* реализован REST API на back-end

* использована тестовая учётка coderex.amocrm.ru
* в работе с API использована библиотека amoCRM https://github.com/amocrm/amocrm-api-php
* БД на PostgreSQL
* в базе осуществляется контроль дублей по id при создании сущности 1 сущность == 1 запись
* обеспечение целостности данных через транзакции при записи сущности
* все ендпоинты указаны в коллекции Postman в collection/ТЗ по ИП Ельмикеев (data-sfera).postman_collection.json
* в не задания реализовано обновление полей B = A + C при любом событии со сделкой
===
    после создания сделки по REST или в интерфейсе, необходимо установить занчения в поля A, B, C
    обновление полей происходит при любом событии со сделкой в интерфейсе Amo CRM либо по REST
    при событии в интерфейсе Amo CRM хук стучится в ендпоинт api/amo-crm на back-end`e
===

---
