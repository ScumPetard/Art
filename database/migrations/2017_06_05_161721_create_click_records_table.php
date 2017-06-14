<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClickRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->string('type');
            $table->string('name');
            $table->string('click_time');
            $table->integer('client_id')->references('id')->on('clients')->onDelete('cascade');
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
        Schema::drop('click_records');
    }
}
