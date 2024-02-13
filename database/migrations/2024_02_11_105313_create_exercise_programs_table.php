<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_programs', function (Blueprint $table) {
            $table->id();
            $table->integer('numberOFSets');
            $table->integer('resetBetweenSets');
            $table->string('dublicatesInSets');
            $table->integer('exerciseArrangement');
            $table->string('exerciseSystem');
            $table->foreignId('programID')->references('id')->on('programs');
            $table->foreignId('exerciseID')->references('id')->on('exercises');
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
        Schema::dropIfExists('exercise_programs');
    }
};
