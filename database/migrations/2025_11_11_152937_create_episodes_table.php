<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('novel_id')->constrained('novels')->onDelete('cascade');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('episode_number')->nullable();
            $table->string('cover_image')->nullable(); 
            $table->string('file_path')->nullable();   
$table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
