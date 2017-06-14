<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('id');
            $table->text('file_name')->comment('文件名称');
            $table->text('china_name')->comment('中文名字');
            $table->text('foreign_name')->comment('外文名字');
            $table->text('alias_name')->comment('别名');
            $table->integer('gender')->comment('性别');
            $table->text('nationality')->comment('国籍');
            $table->text('born')->comment('出生地');
            $table->text('birth_date')->comment('出生日期');
            $table->text('death_address')->comment('翘辫子地点');
            $table->text('death')->comment('翘辫子时间');
            $table->text('art_features')->comment('艺术特点');
            $table->text('art_genre')->comment('艺术流派');
            $table->text('art_date')->comment('艺术时期');
            $table->text('impact')->comment('影响');
            $table->text('motto')->comment('格言');
            $table->text('avatar')->comment('头像');
            $table->text('achievement')->comment('成就');
            $table->text('evaluation')->comment('评价');
            $table->text('intro')->comment('简介');
            $table->integer('domesticandforeign')->comment('国内艺术家或者国外艺术家');
            $table->integer('worktype_id')->references('id')->on('work_types')->onDelete('cascade')->comment('艺术类型');
            $table->integer('workdate_id')->references('id')->on('work_dates')->onDelete('cascade')->comment('艺术时期');
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
        Schema::drop('authors');
    }
}
