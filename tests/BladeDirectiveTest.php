<?php


namespace Nikservik\UserSettings\Tests;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class BladeDirectiveTest extends TestCase
{
    public function test_feature_directive_off()
    {
        $view = View::make('test::test')->render();

        $this->assertStringContainsString('off', $view);
    }
    public function test_feature_directive_on()
    {
        Config::set('test.features', ['feature']);

        $view = View::make('test::test')->render();

        $this->assertStringContainsString('on', $view);
    }
}
