<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGabarit1Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gabarit1', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_variants_id');

            $table->string('img_url')->nullable();
            $table->integer('img_sizeX')->nullable();
            $table->integer('img_sizeY')->nullable();
            $table->integer('img_posX')->nullable();
            $table->integer('img_posY')->nullable();

            $table->string('input_font1')->nullable();
            $table->string('input_font2')->nullable();
            $table->string('input_font3')->nullable();
            $table->string('input_font4')->nullable();

            $table->integer('input_size_maxX')->nullable();
            $table->integer('input_size_maxY')->nullable();

            $table->integer('input_posX')->nullable();
            $table->integer('input_posY')->nullable();

            $table->string('first_char')->nullable();
            $table->integer('char_nbr')->nullable();

            $table->string('font_color1')->nullable();
            $table->string('font_color2')->nullable();
            $table->string('font_color3')->nullable();
            $table->string('font_color4')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gabarit1');
    }
}
