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
        Schema::create('rekomendasis', function (Blueprint $table) {
            $table->id();
            $table->string('perawat_id')->nullable();
            $table->longText('simpulan')->nullable();
            $table->longText('rekomendasi')->nullable();
            $table->string('bidper_auth_id')->nullable();
            $table->date('bidper_date_auth_id')->nullable();
            $table->longText('penilaian_rekomendasi')->nullable();
            $table->longText('feedback')->nullable();
            $table->string('status_pelaporan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasis');
    }
};
