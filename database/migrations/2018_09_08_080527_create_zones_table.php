<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('imageName')->nullable();
            $table->timestamps();
        });

        Schema::create('product_zone', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('zone_id')->unsigned()->index();
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zones');
    }
}
