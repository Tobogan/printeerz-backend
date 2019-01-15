<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->timestamps();
        });

        Schema::create('type_event_event', function(Blueprint $table){
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index();
            $table->integer('type_event_id')->unsigned()->index();
            // $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            // $table->foreign('type_event_id')->references('id')->on('type_events')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_event');
    }
}
