<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('轮播图名称');
            $table->string('url')->nullable()->comment('图片链接');
            $table->string('link')->nullable()->comment('链接地址');
            $table->text('intro')->nullable()->comment('简介');
            $table->integer('sort')->default(0)->comment('排序');
            $table->integer('is_hidden')->default(0)->comment('是否隐藏');
            $table->integer('is_cat')->default(0)->comment('是否是栏目');
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
        Schema::drop('banners');
    }
}
