<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkripsiAlumniSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/skripsi_alumni_cleaned.csv'), 'r');

        $header = fgetcsv($file);

        //  Ambil semua dosen (mapping nama → id)
        $dosens = DB::table('dosen')
            ->get()
            ->mapWithKeys(function ($item) {
                return [strtolower(trim($item->nama_dosen)) => $item->id_dosen];
            });

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            //  Normalisasi
            $p1 = strtolower(trim($data['p1']));
            $p2 = strtolower(trim($data['p2']));

            //  Ambil id dosen
            $id_p1 = $dosens[$p1] ?? null;
            $id_p2 = $dosens[$p2] ?? null;

            //  Kalau salah satu tidak ditemukan → skip
            if (!$id_p1 || !$id_p2) {
                continue;
            }

            //  Insert data
            DB::table('skripsi_alumni')->insert([
                'judul_skripsi' => $data['judul'],
                'id_pembimbing_1' => $id_p1,
                'id_pembimbing_2' => $id_p2,
            ]);
        }

        fclose($file);
    }
}
