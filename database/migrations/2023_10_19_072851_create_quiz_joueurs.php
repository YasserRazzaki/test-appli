<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_joueurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_joueur');
            $table->integer('age');
            $table->string('club');
            $table->string('poste');
            $table->string('nationalite');
            $table->string('image_joueur');
            $table->text('propositions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_joueurs');
    }
};
