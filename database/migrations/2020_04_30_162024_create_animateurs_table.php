<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('profession',50);
            $table->string('animateur_image',150);
            $table->integer('id_evenement');
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
        Schema::dropIfExists('animateurs');
    }
}
