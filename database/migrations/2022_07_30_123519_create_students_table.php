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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50)->unique();
            $table->string('sch_name', 50);
            $table->foreignId('user_id');
            $table->string('class', 50);
            $table->enum('gender', ['L', 'P']);
            $table->integer('age');
            // $table->foreignId('laudio_id');
            // $table->foreignId('linter_id');
            // $table->foreignId('raudio_id');
            // $table->foreignId('rinter_id');
            $table->foreignId('category_id');
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
        Schema::dropIfExists('students');
    }
};
