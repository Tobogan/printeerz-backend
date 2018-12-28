<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id');
            $table->integer('couleur_id');
            $table->integer('taille_id');

            $table->integer('qty')->nullable();
            
            $table->string('couleur_nom')->nullable();
            $table->string('product_nom')->nullable();
            $table->string('taille_nom')->nullable();

            $table->string('zone1')->nullable();
            $table->string('zone2')->nullable();
            $table->string('zone3')->nullable();
            $table->string('zone4')->nullable();

            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();

            $table->enum('gabarit1', ['1','2','3','4'])->nullable();
            $table->enum('gabarit2', ['1','2','3','4'])->nullable();
            $table->enum('gabarit3', ['1','2','3','4'])->nullable();
            $table->enum('gabarit4', ['1','2','3','4'])->nullable();
            
            $table->timestamps();

            Schema::create('product_taille', function(Blueprint $table){
                $table->increments('id');
                $table->integer('product_id')->unsigned()->index();
                $table->integer('taille_id')->unsigned()->index();
            });
    
            // Schema::create('product_variants_taille', function(Blueprint $table){
            //     $table->increments('id');
            //     $table->integer('product_variants_id')->unsigned()->index();
            //     $table->integer('taille_id')->unsigned()->index();
            //     //$table->foreign('productvariants_id')->references('id')->on('productvariants')->onDelete('cascade');
            //     //$table->foreign('taille_id')->references('id')->on('taille')->onDelete('cascade');
            // });

            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
