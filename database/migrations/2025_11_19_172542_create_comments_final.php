<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

           
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

           
            $table->foreignId('novel_id')->nullable()->constrained('novels')->onDelete('cascade');
            $table->foreignId('episode_id')->nullable()->constrained('episodes')->onDelete('cascade');

           
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');

          
            $table->text('comment');

          
            $table->integer('like_count')->default(0);
            $table->integer('unlike_count')->default(0);

           
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('target_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
