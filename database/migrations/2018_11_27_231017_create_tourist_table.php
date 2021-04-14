<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateTouristTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('tourist',function(Blueprint $table){
            $table->increments("id");
            $table->string("name")->nullable();
            $table->string("address")->nullable();
            $table->string("website")->nullable();
            $table->integer("categorytags_id")->references("id")->on("categorytags")->nullable();
            $table->string("mostly_good")->nullable();
            $table->string("user_id")->nullable();
            $table->string("description")->nullable();
            $table->string("photo")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tourist');
    }

}