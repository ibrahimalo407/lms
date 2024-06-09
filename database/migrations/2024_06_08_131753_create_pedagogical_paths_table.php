<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedagogicalPathsTable extends Migration
{
    public function up()
    {
        Schema::create('pedagogical_paths', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('presentation_video')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedagogical_paths');
    }
}

