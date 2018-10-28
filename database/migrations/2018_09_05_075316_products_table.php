<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('reference');
            $table->enum('sexe', ['Femme', 'Homme'])->default('Homme');
            $table->text('description')->nullable();
            $table->string('imageName')->nullable();
            $table->boolean('color_FAV')->default(0);
            $table->boolean('color_FAR')->default(0);
            $table->boolean('color_coeur')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('products');
    // }
}