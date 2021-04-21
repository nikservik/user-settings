<?php


namespace Nikservik\UserSettings\Tests;


use Illuminate\Foundation\Auth\User;

/*
 * Класс пользователя только для тестирования пакета
 */
class TestUser extends User
{
    protected $table = 'users';

    protected $fillable = ['user_settings'];
}
