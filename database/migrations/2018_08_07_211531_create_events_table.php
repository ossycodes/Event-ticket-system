<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            
            $table->string('image');
            $table->string('public_id');
            $table->string('name');
            $table->string('venue');
            $table->mediumText('description');
            $table->string('actors')->nullable();
            $table->string('time');
            $table->string('date');
            $table->string('age');
            $table->string('dresscode')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->string('quantity');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           
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
        Schema::dropIfExists('events');
    }
}
