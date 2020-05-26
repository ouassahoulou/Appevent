<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_attestation');
            $table->integer('id_affiche');
            $table->integer('id_evenement');
            $table->string('titre',50);
            $table->string('locale',50);
            $table->date('date');
            $table->time('heure');
            $table->boolean('free');
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
        Schema::dropIfExists('generations');
    }
}



