<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateTodoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('todo',function(Blueprint $table){
            $table->increments("id");
            $table->string("name")->nullable();
            $table->string("photo")->nullable();
            $table->text("about")->nullable();
            $table->text("contact")->nullable();
            $table->enum("region", ["Region I", "Region II", "Region III", "Region IV", "Region IX", "Region V", "Region VI", "Region VII", "Region VIII", "Region X", "Region XI", "Region XII", "Region XIII", "Region XIV", "Region XV", "Region XVI", "Region XVII"])->nullable();
            $table->string("address")->nullable();
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
        Schema::drop('todo');
    }

}