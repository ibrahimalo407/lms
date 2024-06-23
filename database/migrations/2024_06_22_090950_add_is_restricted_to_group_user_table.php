<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRestrictedToGroupUserTable extends Migration
{
    public function up()
    {
        Schema::table('group_user', function (Blueprint $table) {
            $table->boolean('is_restricted')->default(false);
        });
    }

    public function down()
    {
        Schema::table('group_user', function (Blueprint $table) {
            $table->dropColumn('is_restricted');
        });
    }
}

