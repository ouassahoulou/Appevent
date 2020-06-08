<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantFinanciersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_financiers', function (Blueprint $table) {
            $table->increments('id_participant_financier');
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('telephone',50);
            $table->string('email',50)->unique();
            $table->string('nom_organisme',100);
            $table->float('montant_investi');
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
        Schema::dropIfExists('participant_financiers');
    }
}
