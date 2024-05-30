<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create table with 
        Schema::create('player_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Add level to users table
        Schema::table('users', function($table) {
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id')->references('id')->on('player_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_levels');
        Schema::table('users', function($table) {
            $table->dropColumn(['player_id']);
        });
    }
};
