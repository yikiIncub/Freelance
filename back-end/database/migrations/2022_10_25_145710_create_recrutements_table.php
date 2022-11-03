<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recrutements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('annonce')->nullable();
            $table->string('description')->nullable();
            $table->string('structureRecruteur')->nullable();
            $table->string('secteurActivite')->nullable();
            $table->string('lieuAffectation')->nullable();
            $table->string('diplome')->nullable()->nullable();
            $table->string('niveauEtude')->nullable();
            $table->string('experience')->nullable();
            $table->string('conditionAge')->nullable();
            $table->string('dossier')->nullable();
            $table->string('typeContrat')->nullable();
            $table->string('mailRecruteur')->nullable();
            $table->string('telRecruteur')->nullable();
            $table->string('lien')->nullable();
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
        Schema::dropIfExists('recrutements');
    }
};
