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
        Schema::create('right_audiograms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->integer('r_500');
            $table->integer('r_1000');
            $table->integer('r_2000');
            $table->integer('r_3000');
            $table->integer('r_4000');
            $table->integer('r_6000');
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
        Schema::dropIfExists('right_audiograms');
    }
};
