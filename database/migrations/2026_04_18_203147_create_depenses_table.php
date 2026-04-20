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
        Schema::create('depenses', function (Blueprint $table) {
    $table->id();
    $table->string('description');
    $table->enum('categorie', ['fruits', 'emballages', 'transport', 'livreurs', 'autre']);
    $table->decimal('montant', 10, 2);
    $table->date('date_depense');
    $table->text('notes')->nullable();
    $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
