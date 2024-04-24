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
            Schema::create('salle_attentes', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('rendez_vouses_id');
                $table->Time('heure_arrivee');
                $table->Time('heure_controle')->nullable();
                $table->timestamps();
                $table->foreign('rendez_vouses_id')->references('id')->on('rendez_vouses')->onDelete('cascade');
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salle_attentes');
    }
};
