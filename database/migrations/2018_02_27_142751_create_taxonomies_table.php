<?php

//use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('taxonomy');
            $table->string('term');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('feature_image')->nullable();
            $table->integer('feature_image_id')->unsigned()->nullable();
            $table->string('feature_image_alt')->nullable();
            $table->string('feature_image_title')->nullable();
            $table->timestamps();
            $table->integer('left')->unsigned()->nullable()->default(0);
            $table->integer('right')->unsigned()->nullable()->default(0);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->json('data')->nullable();

            $table->foreign('parent_id')
                ->references('id')
                ->on('taxonomies');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taxonomies');
    }
}
