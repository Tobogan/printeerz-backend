<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouleursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couleurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pantoneName')->nullable();
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('couleur_product', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('couleur_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('couleurs');
    }
}
