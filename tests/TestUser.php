<?php


namespace Nikservik\UserSettings\Tests;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Config;

/*
 * Класс пользователя только для тестирования пакета
 */
class TestUser extends User
{
    protected $table = 'users';

    protected $fillable = ['user_settings'];
}
