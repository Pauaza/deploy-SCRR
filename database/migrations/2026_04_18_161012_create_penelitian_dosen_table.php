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
        Schema::create('penelitian_dosen', function (Blueprint $table) {
            $table->id('id_penelitian');
            $table->unsignedBigInteger('id_dosen');
            $table->text('judul_penelitian');
            $table->text('abstrak_penelitian');
            $table->year('tahun_publikasi');

            $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitian_dosen');
    }
};
