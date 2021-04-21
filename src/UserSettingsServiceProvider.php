<?php

namespace Nikservik\UserSettings;

use Illuminate\Support\ServiceProvider;

class UserSettingsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (! $this->app->runningInConsole())
            return;

        $this->publishes([
            __DIR__ . '/../config/user-settings.php' => config_path('user-settings.php'),
        ], 'user-settings-config');

        if (! class_exists('UpdateUsersTableWithSettings')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/update_users_table_with_settings.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_update_users_table_with_settings.php'),
            ], 'user-settings-migration');
        }
    }

    public function register()
    {
        $this->app->singleton('user-settings', function() {
            return new UserSettingsManager;
        });
        $this->mergeConfigFrom(__DIR__ . '/../config/user-settings.php', 'user-settings');
    }
}
