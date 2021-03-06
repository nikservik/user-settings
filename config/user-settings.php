<?php
// config for Nikservik/UserSettings
return [
    // Какие возможности включены
    // Чтобы отключить возможность, достаточно ее закомментировать
    'features' => [
        'read-defaults-from-config-files',
        'read-user-settings',
        'store-user-settings',
        'read-old-user-settings',
        'replace-old-user-settings',
    ],

    // В каком атрибуте модели User хранятся личные настройки пользователя
    'settings_attribute' =>  'user_settings',
];
