<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateAgencuTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('agencu',function(Blueprint $table){
            $table->increments("id");
            $table->string("photo")->nullable();
            $table->string("name")->nullable();
            $table->string("price")->nullable();
            $table->string("location")->nullable();
            $table->text("coverage")->nullable();
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
        Schema::drop('agencu');
    }

}