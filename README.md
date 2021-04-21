# User settings storage for Laravel

Пакет для управления пользовательскими настройками. 
Хранит настройки в модели User и умеет считывать настройки по умолчанию из пакетов.

## Установка

Установка через composer:

```bash
composer require nikservik/user-settings
```

Опубликовать миграцию и выполнить ее:

```bash
php artisan vendor:publish  --tag="user-settings-migration"
php artisan migrate
```

Опубликовать файл конфигурации, если нужно:
```bash
php artisan vendor:publish  --tag="user-settings-config"
```

Содержание файла конфигурации по умолчанию:

```php
return [
    // Какие возможности включены
    // Чтобы отключить возможность, достаточно ее закомментировать
    'features' => [
        'read-defaults-from-config-files',
        'read-store-user-settings',
        'read-old-user-settings',
        'replace-old-user-settings',
    ],

    // В каком атрибуте модели User хранятся личные настройки пользователя
    'settings_attribute' =>  'user_settings',
];
```
Конфигурацию стоит публиковать только если нужно отключить какие-то возможности или изменить атрибут, в котором будут храниться настройки в модели пользователя.

### Изменение атрибута для сохранения настроек пользователя

По умолчанию настройки хранятся в атрибуте `user_settings`. 

Чтобы его изменить, нужно: 
- опубликовать файл настроек и поменять значение `settings_attribute` на нужное.
- опубликовать файл миграции и поменять в нем название столбца `user_settings` на нужное.
- выполнить миграцию.


## Использование

```php
$method = UserSettings::get('jyotish.charts.D1.method', 'parashara');
```
```php
UserSettings::set('jyotish.charts.D2.method', 'cyclic');
```

## Тестирование

```bash
composer test
```

## История изменений

См. [CHANGELOG](CHANGELOG.md).

## TODO

- Добавить сохранение и восстановление объектов
- Добавить поддержку старых настроек из om.astro.expert (mapping)

