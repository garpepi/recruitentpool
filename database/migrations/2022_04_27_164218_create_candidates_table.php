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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('link_bkp',255);
            $table->string('fullname',255);
            $table->string('email',255);
            $table->string('id_number',255);
            $table->string('tax_number',255)->default('')->nullable();
            $table->longText('home_address');
            $table->string('home_phone',255)->default('')->nullable();
            $table->string('mobile_phone',255);
            $table->date('date_of_birth');
            $table->string('place_of_birth',255);
            $table->string('religion',255);
            $table->string('gender',8);
            $table->tinyInteger('freshgraduate')->default(0);
            $table->string('blood_type',255);
            $table->string('citizenship',255);
            $table->string('marital_status',20);
            $table->string('mariage_year',5)->default('')->nullable();
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
        Schema::dropIfExists('candidates');
    }
};
