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
        Schema::create('refferences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id');
            $table->string('name',50);
            $table->string('phone_number',15);
            $table->string('relationship',20);
            $table->string('position',20);
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
        Schema::dropIfExists('refferences');
    }
};
