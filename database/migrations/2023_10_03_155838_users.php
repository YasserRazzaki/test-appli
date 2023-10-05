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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Colonne ID auto-incrémentée comme clé primaire.
            $table->string('username')->unique(); // Nom d'utilisateur unique.
            $table->string('password'); // Mot de passe hashé.
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('email')->unique(); // Adresse email unique.
            $table->string('profile_picture')->nullable(); // Lien vers la photo de profil (peut être NULL).
            $table->timestamps(); // Colonnes 'created_at' et 'updated_at' pour les timestamps.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};