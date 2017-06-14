<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->references('id')->on('client_id')->onDelete('cascade');
            $table->integer('work_id')->references('id')->on('work_id')->onDelete('cascade');
            $table->integer('num')->default(0);
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
        Schema::drop('client_carts');
    }
}
