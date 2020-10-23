<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('blog_category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('file_id')->unsigned();
            $table->string('name');
            $table->longtext('body');
            $table->timestamps();

            $table->foreign('blog_category_id')->reference('id')->on('blog_categories');
            $table->foreign('user_id')->reference('id')->on('users');
            $table->foreign('file_id')->reference('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
