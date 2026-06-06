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
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('nim_mahasiswa');
            $table->string('topik');
            $table->text('deskripsi_ide');
            // $table->string('metode_pilihan'); // Bayes, SAW, CF, Forward, Backward
            $table->text('hasil_rekomendasi'); // Simpan nama dosen hasil olahan Word2Vec
            $table->timestamps();

            $table->foreign('nim_mahasiswa')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
