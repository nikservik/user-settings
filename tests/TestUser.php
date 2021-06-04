<?php


namespace Nikservik\UserSettings\Tests;

use Illuminate\Foundation\Auth\User;
use Nikservik\UserSettings\Traits\Settings;

/**
 * Класс пользователя только для тестирования пакета
 * @property string $user_settings
 */
class TestUser extends User
{
    use Settings;

    protected $table = 'users';

    protected $fillable = ['name', 'password', 'email', 'user_settings'];

    public static function createWithSettings(array $attributes)
    {
        return TestUser::create(array_merge(['name' => 'Bob', 'password' => 'pass', 'email' => 'bob@example.com'], $attributes));
    }
}
