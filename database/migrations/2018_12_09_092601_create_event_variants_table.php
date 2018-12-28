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
            $table->integer('productVariants_id')->nullable();
            $table->timestamps();
        });

        Schema::create('event_variants_product_variants', function(Blueprint $table){
            $table->increments('id');
            $table->integer('event_variants_id')->unsigned()->index();
            $table->integer('product_variants_id')->unsigned()->index();
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
