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
        Schema::create('non_formal_education', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id');
            $table->string('course_name',50);
            $table->string('year',4);
            $table->string('duration',4);
            $table->string('certificate',4);
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
        Schema::dropIfExists('non_formal_education');
    }
};
