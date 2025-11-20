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
        Schema::create('table_chat', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('sender');
            $table->unsignedInteger('getter');
            $table->json('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_chat');
    }
};
