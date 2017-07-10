<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('steps', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('exercise_id');
          $table->string('name');
          $table->integer('reps');
          $table->integer('sets');
          $table->timestamps();
      });

      // Create pivot table for user relationship
      Schema::create('day_step', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('day_id');
          $table->integer('step_id');
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
        Schema::dropIfExists('steps');
        // Pivot
        Schema::dropIfExists('day_step');

    }
}
