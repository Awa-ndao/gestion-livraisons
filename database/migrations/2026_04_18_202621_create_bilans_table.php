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
        Schema::create('bilans', function (Blueprint $table) {
    $table->id();
    $table->enum('type', ['hebdomadaire', 'mensuel']);
    $table->date('date_debut');
    $table->date('date_fin');
    $table->decimal('total_encaisse', 10, 2)->default(0);
    $table->integer('nombre_livraisons')->default(0);
    $table->integer('nombre_colis_livres')->default(0);
    $table->integer('nombre_colis_annules')->default(0);
    $table->integer('nouveaux_clients')->default(0);
    $table->text('observations')->nullable();
    $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bilans');
    }
};
