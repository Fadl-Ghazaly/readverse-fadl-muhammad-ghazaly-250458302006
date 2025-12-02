<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('novel_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained('episodes')->onDelete('cascade');
            $table->integer('page_number')->nullable();  
            $table->string('image_path')->nullable();      
            $table->string('file_path')->nullable();      
            $table->text('caption')->nullable();          
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('novel_pages');
    }
};
