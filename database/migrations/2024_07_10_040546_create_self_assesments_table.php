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
        Schema::create('self_assesments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perawat_id')->nullable();
            $table->date('tanggal_self_assesment')->nullable();
            $table->string('index')->nullable();
            $table->longText('record_self_assesment')->nullable();
            $table->string('hasil_jawaban_self_assesment')->nullable();
            $table->string('jawaban_buku_karu_tingkat_kemapuan_vokasi')->nullable();
            $table->string('jawaban_buku_karu_tingkat_kemapuan_ners')->nullable();
            $table->string('jawaban_konversi')->nullable();
            $table->string('pertanyaan')->nullable();
            $table->string('is_vokasi_or_ners')->nullable();
            $table->string('flag_skp')->nullable();
            $table->string('hasil')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_assesments');
    }
};
