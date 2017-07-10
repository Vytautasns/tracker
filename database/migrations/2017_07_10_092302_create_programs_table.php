<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('image_url');
            $table->integer('default');
            $table->timestamps();
        });

        // Create pivot table for user relationship
        Schema::create('program_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('program_id');
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
        Schema::dropIfExists('programs');

        // Drop pivot table
        Schema::dropIfExists('program_user');

    }
}
