<?php

namespace Nikservik\UserSettings\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as Orchestra;
use Nikservik\UserSettings\UserSettingsServiceProvider;
use Illuminate\Support\Facades\Facade;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            UserSettingsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        include_once __DIR__.'/../database/migrations/update_users_table_with_settings.php.stub';
        (new \UpdateUsersTableWithSettings)->up();
    }
}
