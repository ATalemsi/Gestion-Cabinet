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
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rendez_vouses_id');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_status', ['pending', 'paid'])->default('pending'); // Payment status
            $table->timestamps();
            $table->foreign('rendez_vouses_id')->references('id')->on('rendez_vouses')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payments');
    }
};
