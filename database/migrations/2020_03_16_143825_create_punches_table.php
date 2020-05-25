<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userid');
            $table->integer('punch_year_month');
            $table->integer('punch_date');
            $table->string('punch_time');
            $table->integer('punch_end_year_month')->nullable();
            $table->integer('punch_end_date')->nullable();
            $table->string('punch_end_time')->nullable();
            $table->string('description');
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
        Schema::dropIfExists('punches');
    }
}
