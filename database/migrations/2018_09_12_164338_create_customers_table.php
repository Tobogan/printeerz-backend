<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('adress');
            $table->string('postal_code');
            $table->string('city');
            $table->string('siren')->nullable();
            $table->string('activity')->default('inconnu');
            $table->string('event_id')->nullable();
            $table->integer('event_qty')->nullable();
            $table->integer('print_qty')->nullable();
            $table->string('contact_lastname');
            $table->string('contact_firstname');
            $table->string('contact_phone');
            $table->string('contact_job');
            $table->string('contact_email')->default('john@doe.com');
            $table->text('informations')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
