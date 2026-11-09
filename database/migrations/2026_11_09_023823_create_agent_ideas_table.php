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
        Schema::create('agent_ideas', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('author', 100);
            $table->string('nrp', 20);
            $table->string('title');
            $table->string('category')->default('Autonomous Agentic System');
            $table->string('architecture')->default('ReAct Multi-Agent Loop');
            $table->string('target_user')->default('Mahasiswa & Dosen');
            $table->string('priority')->default('Tinggi'); // Rendah, Sedang, Tinggi, Kritis
            $table->text('description')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('status')->default('Review'); // Review, Disetujui, Ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_ideas');
    }
};
