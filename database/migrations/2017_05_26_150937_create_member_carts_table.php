<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->references('id')->on('member_id')->onDelete('cascade');
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
        Schema::drop('member_carts');
    }
}
