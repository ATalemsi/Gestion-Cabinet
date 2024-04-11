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
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('cin')->nullable();
            $table->dateTime('date_heure');
            $table->string('mutuelles')->nullable();
            $table->enum('statut', ['nouveau', 'pris en charge', 'terminé', 'reporté'])->default('nouveau');
            $table->enum('type_patient', ['nouveau', 'ancien', 'contrôle'])->default('nouveau');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
