# User settings storage for Laravel

[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/nikservik/user_settings/run-tests?label=tests)](https://github.com/nikservik/user_settings/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/nikservik/user_settings/Check%20&%20fix%20styling?label=code%20style)](https://github.com/nikservik/user_settings/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require nikservik/user-settings
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish  --tag="user-settings-migration"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish  --tag="user-settings-config"
```

This is the contents of the published config file:

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

## Usage

```php
$method = UserSettings::get('jyotish.charts.D1.method', 'parashara');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Sergey Nikiforov](https://github.com/nikservik)

## License

Commercial license. 
