<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableWithSettings extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('users')) {
            // Для тестирования пакета
            // Если нет таблицы пользователей, то создаем таблицу-заготовку
            Schema::create('users', function (Blueprint $table) {
                $table->id();

                $table->timestamps();
            });
        }

        if (! Schema::hasColumn('users', Config::get('user-settings.settings_attribute'))) {
            Schema::table('users', function (Blueprint $table) {
                $table->json(Config::get('user-settings.settings_attribute'))->nullable();
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', Config::get('user-settings.settings_attribute'))) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(Config::get('user-settings.settings_attribute'));
            });
        }
    }
}
