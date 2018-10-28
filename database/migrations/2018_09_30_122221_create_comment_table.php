<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('event_id')->nullable();
            $table->string('user_id')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });

        Schema::create('comment_user', function(Blueprint $table){
            $table->increments('id');
            $table->integer('comment_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
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
        Schema::dropIfExists('comments');
    }
}
