<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('claims', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Definisikan secara manual foreign key ke tabel 'clothes' kolom 'id'
        $table->unsignedBigInteger('cloth_id');
        $table->foreign('cloth_id')->references('id')->on('clothes')->onDelete('cascade');

        $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};