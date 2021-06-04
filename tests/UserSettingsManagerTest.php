<?php

namespace Nikservik\UserSettings\Tests;

use Illuminate\Support\Facades\Config;
use Nikservik\UserSettings\UserSettings;

class UserSettingsManagerTest extends TestCase
{
    public function testGetNoUserNoConfigFromDefault()
    {
        $this->assertEquals('test', UserSettings::get('test-package.nonexist', 'test'));
    }

    public function testGetNoUserFromConfigDefault()
    {
        Config::set('test-package.defaults.test_setting', 'test_value');

        $this->assertEquals('test_value', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testGetNoUserConfigDefaultsDisabled()
    {
        Config::set('test-package.defaults.test_setting', 'test_value');
        Config::set('user-settings.features', []);

        $this->assertEquals('default', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testUserHasSetting()
    {
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertEquals('user_value', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testUserHasEmptySettings()
    {
        $user = TestUser::createWithSettings(['user_settings' => null]);

        $this
            ->actingAs($user)
            ->assertEquals('default', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testUserHasSettingButUserSettingsReadingDisabled()
    {
        Config::set('user-settings.features', []);
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertEquals('default', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testUserHasSettingButUserSettingsReadingDisabledReadsFromConfigDefaults()
    {
        Config::set('user-settings.features', ['read-defaults-from-config-files',]);
        Config::set('test-package.defaults.test_setting', 'test_value');
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertEquals('test_value', UserSettings::get('test-package.test_setting', 'default'));
    }

    public function test_get_user_setting_with_value_false()
    {
        Config::set('test-package.defaults.test_setting', true);
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":false}}']);

        $this
            ->actingAs($user)
            ->assertEquals(false, UserSettings::get('test-package.test_setting', 'default'));
    }

    public function testSetAddsSetting()
    {
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertNotNull(UserSettings::set('test-package.new_setting', 'test'));

        $this
            ->actingAs($user)
            ->assertEquals('test', UserSettings::get('test-package.new_setting'));
    }

    public function testSetReplacesSetting()
    {
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertNotNull(UserSettings::set('test-package.test_setting', 'test'));

        $this
            ->actingAs($user)
            ->assertEquals('test', UserSettings::get('test-package.test_setting'));
    }

    public function testSetDoesNotAddsSettingWhenStoreUserSettingsDisabled()
    {
        Config::set('user-settings.features', ['read-user-settings',]);
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertNotNull(UserSettings::set('test-package.new_setting', 'test'));

        $this
            ->actingAs($user)
            ->assertNull(UserSettings::get('test-package.new_setting'));
    }

    public function testSetDoesNotReplaceSettingWhenStoreUserSettingsDisabled()
    {
        Config::set('user-settings.features', ['read-user-settings',]);
        $user = TestUser::createWithSettings(['user_settings' => '{"test-package":{"test_setting":"user_value"}}']);

        $this
            ->actingAs($user)
            ->assertNotNull(UserSettings::set('test-package.test_setting', 'test'));

        $this
            ->actingAs($user)
            ->assertEquals('user_value', UserSettings::get('test-package.test_setting'));
    }
}
