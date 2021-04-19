<?php

namespace Nikservik\UserSettings;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nikservik\UserSettings\UserSettingsManager
 */
class UserSettings extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user-settings';
    }
}
