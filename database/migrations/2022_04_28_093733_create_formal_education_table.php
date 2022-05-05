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
        Schema::create('formal_education', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id');
            $table->string('institution',50);
            $table->string('grades',10);
            $table->string('gpa',4);
            $table->string('city',50);
            $table->string('start',25);
            $table->string('graduates',25);
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
        Schema::dropIfExists('formal_education');
    }
};
