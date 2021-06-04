<?php

namespace Nikservik\UserSettings\Tests\Traits;

use Nikservik\UserSettings\Tests\TestCase;
use Nikservik\UserSettings\Tests\TestUser;

class SettingsTest extends TestCase
{
    public function test_get_settings_value_null_on_empty()
    {
        $user = TestUser::createWithSettings(['user_settings' => null]);

        $this->assertNull($user->getSettingsValue('nothing.nowhere'));
    }

    public function test_get_something_somewhere()
    {
        $user = TestUser::createWithSettings(['user_settings' => '{"something":{"somewhere":42}}']);

        $this->assertSame(42, $user->getSettingsValue('something.somewhere'));
    }

    public function test_set_get()
    {
        $user = TestUser::createWithSettings(['user_settings' => null]);

        $user->setSettingsValue('something.somewhere', 42);

        $this->assertSame(42, $user->getSettingsValue('something.somewhere'));
    }
}
