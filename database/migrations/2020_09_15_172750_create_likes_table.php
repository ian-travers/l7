<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('liked_id');
            $table->string('liked_type', 50);
            $table->timestamps();

            $table->unique(['user_id', 'liked_id', 'liked_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}
