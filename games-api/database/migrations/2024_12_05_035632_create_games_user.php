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
        Schema::create('games_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('games_id')->nullable()->constrained('games');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games_user');
    }
};
