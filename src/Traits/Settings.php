<?php


namespace Nikservik\UserSettings\Traits;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;

trait Settings
{
    public function getSettingsValue(string $path)
    {
        $settingsAttribute = Config::get('user-settings.settings_attribute');

        return Arr::get(json_decode($this->$settingsAttribute, true) ?? [], $path);
    }

    public function setSettingsValue(string $path, $value)
    {
        $settingsAttribute = Config::get('user-settings.settings_attribute');

        $settings = json_decode($this->$settingsAttribute, true) ?? [];
        Arr::set($settings, $path, $value);

        $this->$settingsAttribute = json_encode($settings);
    }
}
