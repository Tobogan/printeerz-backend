<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGabaritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gabarits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('product_gabarit', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('gabarit_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gabarits');
    }
}
