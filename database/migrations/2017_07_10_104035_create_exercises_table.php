<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('exercises', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id');
          $table->string('name');
          $table->string('image_url')->nullable();
          $table->string('description')->nullable();
          $table->integer('default');
          $table->timestamps();
      });

      // Create pivot table for user relationship
      Schema::create('exercise_user', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('exercise_id');
          $table->integer('user_id');
          $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercises');
        Schema::dropIfExists('exercise_user');

    }
}
