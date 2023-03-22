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
        Schema::create('telegram_status', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('status');
            $table->string('user_id');
            $table->string('name');
            $table->string('input')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_status');
    }
};
