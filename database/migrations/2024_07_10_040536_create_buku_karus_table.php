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
        Schema::create('buku_karus', function (Blueprint $table) {
            $table->id();
            $table->string('skp_code');
            $table->string('skp_title');
            $table->string('kompetensi_inti');
            $table->longText('skp_desc')->nullable();
            $table->longText('sub_kompetensi_dan_kode');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_karus');
    }
};
