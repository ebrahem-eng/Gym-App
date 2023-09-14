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
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('phone');
            $table->integer('age');
            $table->string('address');
            $table->string('img')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('gender')->default(1);
            $table->foreignId('salary_id')->references('id')->on('salaries');
            $table->foreignId('created_by')->references('id')->on('admins');
            $table->foreignId('work_time_id')->references('id')->on('times');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('trainers');
    }
};
