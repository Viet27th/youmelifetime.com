<?php

//use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('option_date')->nullable();
            $table->string('status')->nullable();
            $table->string('feature_image')->nullable();
            $table->integer('feature_image_id')->unsigned()->nullable();
            $table->string('feature_image_alt')->nullable();
            $table->string('feature_image_title')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
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
