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
        Schema::create('paiements', function (Blueprint $table) {
    $table->id();
    $table->decimal('montant', 10, 2);
    $table->enum('mode_paiement', ['cash', 'orange_money', 'wave'])->default('cash');
    $table->enum('statut', ['en_attente', 'payé'])->default('en_attente');
    $table->foreignId('livraison_id')->constrained('livraisons')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
