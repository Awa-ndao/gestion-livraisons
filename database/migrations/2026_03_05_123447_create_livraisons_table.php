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
        Schema::create('livraisons', function (Blueprint $table) {
    $table->id();
    $table->date('date_livraison');
    $table->enum('statut', ['planifiée', 'en_cours', 'livrée', 'annulée'])->default('planifiée');
    $table->foreignId('colis_id')->constrained('colis')->onDelete('cascade');
    $table->foreignId('livreur_id')->constrained('livreurs')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
