<?php

namespace Nikservik\UserSettings\Tests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Nikservik\UserSettings\UserSettingsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use DatabaseTransactions;

    protected function getPackageProviders($app)
    {
        return [
            UserSettingsServiceProvider::class,
            TestServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'mysql');
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
