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
            $table->string('annonceur');
            $table->string('logoName')->nullable();
            $table->string('imageName1')->nullable();
            $table->string('imageName2')->nullable();
            $table->string('veille_imageName')->nullable();
            $table->string('accueil_imageName')->nullable();
            $table->string('BAT_name')->nullable();
            $table->string('lieu')->default('Inconnu');
            $table->datetime('date')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            
            $table->string('color1')->nullable();
            $table->string('color1_coeur_imageName')->nullable();
            $table->string('color1_coeur_gabarit')->nullable();
            $table->string('color1_FAV_imageName')->nullable();
            $table->string('color1_FAV_gabarit')->nullable();
            $table->string('color1_FAR_imageName')->nullable();
            $table->string('color1_FAR_gabarit')->nullable();
            $table->boolean('color1_FAV')->default(0);
            $table->boolean('color1_FAR')->default(0);
            $table->boolean('color1_coeur')->default(0);

            $table->string('color2')->nullable();
            $table->string('color2_coeur_imageName')->nullable();
            $table->string('color2_coeur_gabarit')->nullable();
            $table->string('color2_FAV_imageName')->nullable();
            $table->string('color2_FAV_gabarit')->nullable();
            $table->string('color2_FAR_imageName')->nullable();
            $table->string('color2_FAR_gabarit')->nullable();
            $table->boolean('color2_FAV')->default(0);
            $table->boolean('color2_FAR')->default(0);
            $table->boolean('color2_coeur')->default(0);

            $table->string('color3')->nullable();
            $table->string('color3_coeur_imageName')->nullable();
            $table->string('color3_coeur_gabarit')->nullable();
            $table->string('color3_FAV_imageName')->nullable();
            $table->string('color3_FAV_gabarit')->nullable();
            $table->string('color3_FAR_imageName')->nullable();
            $table->string('color3_FAR_gabarit')->nullable();
            $table->boolean('color3_FAV')->default(0);
            $table->boolean('color3_FAR')->default(0);
            $table->boolean('color3_coeur')->default(0);
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
