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
        Schema::create('profil_perawats', function (Blueprint $table) {
            $table->id();
            $table->string('namalengkap');
            $table->string('jeniskelamin')->nullable();
            $table->text('alamat_ktp')->nullable();
            $table->text('alamat_tinggal')->nullable();
            $table->string('unit_tempat_bekerja_terakhir')->nullable();
            $table->date('mulai_bergabung_dirumah_sakit')->nullable();
            $table->date('mulai_bekerja_diunit_terakhir')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('is_vokasi_ners')->nullable();
            $table->string('user_id')->nullable();
            $table->string('asal_institusi_pendidikan_terakhir')->nullable();
            $table->year('kelulusan_tahun')->nullable();
            $table->date('tanggal_terbit_str')->nullable();
            $table->date('tanggal_berakhir_masa_berlaku_str')->nullable();
            $table->date('tanggal_terbit_sipp')->nullable();
            $table->string('jabatan_anda_saat_ini')->nullable();
            $table->string('level_pk_anda_saat_ini')->nullable();
            $table->string('level_pk_yang_diajukan')->nullable();
            $table->string('level_perawat_manajer_saat_ini')->nullable();
            $table->string('orientasi')->nullable();         
            $table->string('cpd')->nullable();
            $table->string('cpd_pk_1')->nullable();
            $table->string('cpd_pk_2')->nullable();
            $table->string('cpd_pk_3')->nullable();
            $table->string('cpd_pk_4')->nullable();
            $table->string('cpd_pk_5')->nullable();
            $table->string('program_mutu')->nullable();
            $table->string('setuju');
            //$table->string('email')->unique();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_perawats');
    }
};
