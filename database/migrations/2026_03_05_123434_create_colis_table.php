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
        Schema::create('colis', function (Blueprint $table) {
    $table->id();
    $table->string('description');
    $table->decimal('poids', 8, 2);
    $table->enum('statut', ['en_attente', 'en_cours', 'livré', 'annulé'])->default('en_attente');
    $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};
