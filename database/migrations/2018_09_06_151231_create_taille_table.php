<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTailleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tailles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });
    
        Schema::create('product_taille', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('taille_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tailles');
    }
}
