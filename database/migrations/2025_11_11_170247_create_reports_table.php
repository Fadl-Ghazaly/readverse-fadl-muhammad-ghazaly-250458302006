<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('novel_id')->nullable()->constrained('novels')->onDelete('cascade');
            $table->foreignId('episode_id')->nullable()->constrained('episodes')->onDelete('cascade');
            $table->string('kategori'); 
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['Baru', 'Diproses', 'Selesai'])->default('Baru');
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
