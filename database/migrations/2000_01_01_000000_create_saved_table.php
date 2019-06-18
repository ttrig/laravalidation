<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavedTable extends Migration
{
    public function up()
    {
        Schema::create('saved', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip', 15);
            $table->text('json');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('saved');
    }
}
