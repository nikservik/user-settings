<?php


namespace Nikservik\UserSettings\Contracts;


interface UserSettingsInterface
{
    /*
     * Возвращает значение запрошенной настройки
     *
     * $name задается так же, как и для Config:get()
     *
     * Приоритетность поиска:
     * - личные настройки пользователя
     * - значение по умолчанию в конфигурации модуля
     * - переданное умолчание или null
     */
    public function get(string $name, $default = null);

    /*
     * Сохраняет значение настройки в личных настройках пользователя
     */
    public function set(string $name, $value);
}
