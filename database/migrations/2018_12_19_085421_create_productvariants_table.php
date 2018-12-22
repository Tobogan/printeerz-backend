<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductvariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productvariants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('couleur_id');
            //$table->integer('taille_id')->unsigned();
            $table->string('nom')->nullable();
            //$table->string('taille_nom')->nullable();
            $table->string('pantone')->nullable();
            $table->string('zone1')->nullable();
            $table->string('zone2')->nullable();
            $table->string('zone3')->nullable();
            $table->string('zone4')->nullable();
            $table->string('zone5')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image5')->nullable();
            $table->timestamps();
        });

        Schema::create('product_taille', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('taille_id')->unsigned()->index();
        });

        Schema::create('productvariants_taille', function(Blueprint $table){
            $table->increments('id');
            $table->integer('productvariants_id')->unsigned()->index();
            $table->integer('taille_id')->unsigned()->index();
            //$table->foreign('productvariants_id')->references('id')->on('productvariants')->onDelete('cascade');
            //$table->foreign('taille_id')->references('id')->on('taille')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productvariants');
    }
}
