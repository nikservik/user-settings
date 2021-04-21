<?php

namespace Nikservik\UserSettings;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Nikservik\UserSettings\Contracts\UserSettingsInterface;

class UserSettingsManager implements UserSettingsInterface
{
    protected string $settingsAttribute;

    public function __construct()
    {
        $this->settingsAttribute = Config::get('user-settings.settings_attribute');
    }

    public function get(string $name, $default = null)
    {
        if ($value = $this->getFromUserSettings(Auth::user(), $name)) {
            return $value;
        }

        if ($value = $this->getFromConfigDefaults($name)) {
            return $value;
        }

        return $default;
    }

    public function set(string $name, $value): self
    {
        if (! $user = Auth::user()) {
            return $this;
        }

        $settings = $this->getUserSettings($user);

        Arr::set($settings, $name, $value);

        $this->setUserSettings($user, $settings);

        return $this;
    }

    protected function getFromUserSettings($user, $name)
    {
        if (! $user instanceof User) {
            return null;
        }

        if (! in_array('read-user-settings', Config::get('user-settings.features'))) {
            return null;
        }

        return Arr::get($this->getUserSettings($user), $name);
    }

    protected function getFromConfigDefaults($name)
    {
        if (! in_array('read-defaults-from-config-files', Config::get('user-settings.features'))) {
            return null;
        }

        $config = Str::before($name, '.');
        $attribute = Str::after($name, '.');

        return Config::get($config . '.defaults.' . $attribute);
    }

    protected function getUserSettings(Authenticatable $user): array
    {
        $settingsAttribute = $this->settingsAttribute;

        return json_decode($user->$settingsAttribute, true);
    }

    protected function setUserSettings(Authenticatable $user, array $settings): void
    {
        if (! in_array('store-user-settings', Config::get('user-settings.features'))) {
            return;
        }

        $settingsAttribute = $this->settingsAttribute;

        $user->$settingsAttribute = json_encode($settings);
    }
}
