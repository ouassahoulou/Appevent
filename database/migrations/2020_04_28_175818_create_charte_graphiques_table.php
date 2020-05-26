<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharteGraphiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charte_graphiques', function (Blueprint $table) {
            $table->increments('id_charte');
            $table->string('logo');
            $table->string('typographie');
            $table->string('palette_couleur');
            $table->string('brand_story');
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
        Schema::dropIfExists('charte_graphiques');
    }
}
