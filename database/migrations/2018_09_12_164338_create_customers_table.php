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
            $table->string('denomination');
            $table->string('adresse');
            $table->string('code_postal');
            $table->string('ville');
            $table->string('siren')->nullable();
            $table->string('activite')->default('inconnu');
            $table->string('event_id')->nullable();
            $table->integer('nb_events')->nullable();
            $table->integer('nb_impression')->nullable();
            $table->string('contact_nom');
            $table->string('contact_prenom');
            $table->string('contact_telephone');
            $table->string('contact_poste');
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
