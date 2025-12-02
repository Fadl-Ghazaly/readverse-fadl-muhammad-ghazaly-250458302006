<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    if (!Schema::hasTable('notifications')) {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type')->default('system');
            $table->string('message');
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
        });
    }
    if (!Schema::hasColumn('users', 'notifications_enabled')) {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('notifications_enabled')->default(true);
        });
    }
}
public function down(): void
{
    if (Schema::hasTable('notifications')) {
        Schema::dropIfExists('notifications');
    }

    if (Schema::hasColumn('users', 'notifications_enabled')) {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('notifications_enabled');
        });
    }
}
};