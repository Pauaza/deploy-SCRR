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
        Schema::create('skripsi_alumni', function (Blueprint $table) {
            $table->id('id_skripsi');
            $table->text('judul_skripsi');
            $table->unsignedBigInteger('id_pembimbing_1');
            $table->unsignedBigInteger('id_pembimbing_2');

            $table->foreign('id_pembimbing_1')->references('id_dosen')->on('dosen')->onDelete('cascade');
            $table->foreign('id_pembimbing_2')->references('id_dosen')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skripsi_alumni');
    }
};
