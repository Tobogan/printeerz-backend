<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->integer('customer_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('productVariants_id')->nullable();
            $table->string('annonceur');
            $table->string('logoName')->nullable();
            $table->string('BAT_name')->nullable();
            $table->string('lieu')->default('Inconnu');
            $table->datetime('date')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('customer_event', function(Blueprint $table){
            $table->increments('id');
            $table->integer('customer_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
        });

        Schema::create('event_product', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
        });

        Schema::create('event_product_variants', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_variants_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
        });

        Schema::create('comment_event', function(Blueprint $table){
            $table->increments('id');
            $table->integer('comment_id')->unsigned()->index();
            $table->integer('event_id')->unsigned()->index();
        });

        Schema::create('event_user', function(Blueprint $table){
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
        });
    }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('events');
//     }
}
