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
        Schema::create('additional_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('candidate_id');
            $table->string("job_source_info",100);
            $table->string("hospitalize_status",5);
            $table->string("serious_ill",50)->nullable();
            $table->string("strenght",100);
            $table->string("weakness",100);
            $table->string("overcome_weakness",100);
            $table->integer("expected_salary");
            $table->string("estimate_join_date",15);
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
        Schema::dropIfExists('additional_information');
    }
};
