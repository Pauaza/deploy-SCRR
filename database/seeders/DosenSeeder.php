<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/lab_dosen.csv'), 'r');

        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            //  Ambil id_lab berdasarkan nama_lab
            $lab = DB::table('lab_dosen')
                ->where('nama_lab', $data['nama_lab'])
                ->first();

            //  Kalau lab tidak ditemukan, skip
            if (!$lab) {
                continue;
            }

            //  Normalisasi nama dosen
            $nama = trim($data['nama_dosen']);

            //  Cek apakah dosen sudah ada
            $dosen = DB::table('dosen')
                ->where('nama_dosen', $nama)
                ->first();

            //  Jika belum ada, baru insert
            if (!$dosen) {
                DB::table('dosen')->insert([
                    'nama_dosen' => $nama,
                    'id_lab' => $lab->id_lab,
                ]);
            }
        }

        fclose($file);
    }
}
