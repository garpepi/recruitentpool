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
        Schema::create('working_experiences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id');
            $table->boolean('working_status');
            $table->string('industry', 50);
            $table->string('address', 150);
            $table->string('start', 10);
            $table->string('exit', 10)->nullable();
            $table->string('exit_reasons', 255)->nullable();
            $table->string('allowance', 500)->nullable();
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
        Schema::dropIfExists('working_experiences');
    }
};
