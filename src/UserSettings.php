<?php

namespace Nikservik\UserSettings;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed get(string $name, $default = null)
 * @method static UserSettingsManager set(string $name, $value)
 */
class UserSettings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user-settings';
    }
}
