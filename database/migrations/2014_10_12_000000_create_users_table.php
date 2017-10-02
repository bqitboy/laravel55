<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->engine = 'InnoDB'; //数据库引擎

            $table->increments('id');
            $table->string('name')->unique()->comment('账号');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('realname')->comment('真是姓名');
            $table->string('avatar')->comment('用户头像');
            $table->string('confirmation_token')->comment(' 确认token');
            $table->smallInteger('is_active')->default(0)->comment('1：激活 0：未激活');
            $table->integer('questions_count')->default(0)->comment('提问数');
            $table->integer('answers_count')->default(0)->comment('回答数');
            $table->integer('comments_count')->default(0)->comment('评论数');
            $table->integer('favorites_count')->default(0)->comment('收藏数');
            $table->integer('likes_count')->default(0)->comment('点赞数');
            $table->integer('followers_count')->default(0)->comment('关注数');
            $table->integer('followings_count')->default(0)->comment('被关注数');
            $table->json('settings')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
