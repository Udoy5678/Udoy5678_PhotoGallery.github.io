<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img_title')->unique();
            $table->string('img_description');
            $table->string('img_visibility')->nullable();
            $table->binary('image');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('userinfos');
            
            
            
            
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
        Schema::dropIfExists('user_imgs');
    }
}
