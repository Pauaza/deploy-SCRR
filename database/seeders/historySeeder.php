<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\History;
use Carbon\Carbon;

class HistorySeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = [
            '2341760063',
            '2341760192',
            '2341760107',
            '2341760002',
            '2341760061',
        ];

        $dosen = [
            'Ade Ismail S.Kom., M.TI',
            'Dr. Yuri Ariyanto, S.Kom., M.Kom.',
            'Dika Rizky Yunianto, S.Kom, M.Kom',
            'Dr. Rakhmat Arianto, S.ST., M.Kom.',
            'Erfan Rohadi, ST., M.Eng., Ph.D.',
            'Imam Fahrur Rozi, ST., MT.',
            'Prof. Dr. Eng. Rosa Andrie Asmara, ST., MT.',
            'Hendra Pradibta, SE., M.Sc.',
        ];

        $topikList = [
            'IoT Smart Farming',
            'Data Mining Penjualan',
            'Machine Learning Prediksi',
            'Sistem Rekomendasi Skripsi',
            'Computer Vision Deteksi Objek',
            'Cyber Security Monitoring',
            'Mobile App Absensi Mahasiswa',
            'Sistem Informasi Akademik',
        ];

        for ($i = 0; $i < 25; $i++) {

            $randomDays = rand(0, 9);

            History::create([
                'nim_mahasiswa' => $mahasiswa[array_rand($mahasiswa)],
                'topik' => $topikList[array_rand($topikList)],
                'deskripsi_ide' => 'Implementasi sistem berbasis ' . $topikList[array_rand($topikList)] . ' untuk kebutuhan penelitian mahasiswa.',
                'hasil_rekomendasi' => $dosen[array_rand($dosen)],

                // 🔥 RANDOM CREATED AT 10 HARI TERAKHIR
                'created_at' => Carbon::now()->subDays($randomDays)->subMinutes(rand(0, 1440)),
                'updated_at' => Carbon::now()->subDays($randomDays)->subMinutes(rand(0, 1440)),
            ]);
        }
    }
}