<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('productvariants_id')->nullable();
            $table->integer('taille_id')->nullable();
            $table->timestamps();
        });

        Schema::create('event_variants_productvariants', function(Blueprint $table){
            $table->increments('id');
            $table->integer('event_variants_id')->unsigned()->index();
            $table->integer('productvariants_id')->unsigned()->index();
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
        Schema::dropIfExists('event_variants');
    }
}
