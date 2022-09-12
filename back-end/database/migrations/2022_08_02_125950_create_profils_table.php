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
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->string('competence_verifie');
            $table->foreignId('user_id')->constrained()->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('domaine_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('competence_id')->constrained()->onUpdate('cascade') ->onDelete('cascade');
            $table->foreignId('specialite_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('profils');
    }
};
