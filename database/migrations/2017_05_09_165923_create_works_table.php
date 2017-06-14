<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->text('file_name')->nullable()->comment('文件名称');
            $table->text('work_name')->nullable()->comment('作品名称');
            $table->integer('author_id')->nullable()->references('id')->on('authors')->onDelete('cascade')->comment('作者ID');
            $table->text('countries')->nullable()->comment('国家');
            $table->text('creation_time')->nullable()->comment('创作时间');
            $table->text('material')->nullable()->comment('材质');
            $table->text('size')->nullable()->comment('大小');
            $table->integer('worktype_id')->nullable()->references('id')->on('work_types')->onDelete('cascade')->comment('作品类型');
            $table->text('creating_location')->nullable()->comment('创作地址');
            $table->text('collection_location')->nullable()->comment('收藏地址');
            $table->text('small_image')->nullable()->comment('略缩图');
            $table->text('big_image')->nullable()->comment('高清图');
            $table->text('qrcode')->comment('二维码');
            $table->text('intro')->comment('简介');
            $table->integer('is_complete')->default('1')->comment('是否完成');
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
        Schema::drop('works');
    }
}
