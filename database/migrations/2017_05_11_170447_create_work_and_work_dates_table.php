<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkAndWorkDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_and_work_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('work_id')->references('id')->on('works')->onDelete('cascade');
            $table->integer('workdate_id')->references('id')->on('work_dates')->onDelete('cascade');
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
        Schema::drop('work_and_work_dates');
    }
}
