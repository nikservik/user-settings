<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableWithSettings extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('user_settings')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_settings');
        });
    }
}
