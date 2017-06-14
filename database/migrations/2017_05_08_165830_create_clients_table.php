<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('机构客户名称');
            $table->string('logo')->comment('logo图片');
            $table->string('account')->comment('账号');
            $table->string('password')->comment('密码');
            $table->string('province')->comment('省');
            $table->string('type')->comment('类型');
            $table->string('version')->comment('版本');
            $table->integer('downloads')->comment('单日下载量');
            $table->string('start_ip')->comment('开始ip');
            $table->string('end_ip')->comment('结束ip');
            $table->integer('buy')->comment('是否开启购画车权限');
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
        Schema::drop('clients');
    }
}
