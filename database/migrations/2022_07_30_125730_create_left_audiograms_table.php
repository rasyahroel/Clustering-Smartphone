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
        Schema::create('left_audiograms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->integer('l_500');
            $table->integer('l_1000');
            $table->integer('l_2000');
            $table->integer('l_3000');
            $table->integer('l_4000');
            $table->integer('l_6000');
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
        Schema::dropIfExists('left_audiograms');
    }
};
