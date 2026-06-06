<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenelitianDosenSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/penelitian_dosen.csv'), 'r');

        $header = fgetcsv($file);

        //  Ambil semua dosen (biar tidak query berulang)
        $dosens = DB::table('dosen')
            ->pluck('id_dosen', 'nama_dosen');
        // hasil: ['Budi' => 1, 'Siti' => 2]

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            //  normalisasi nama
            $nama = trim($data['nama_dosen']);

            //  ambil id_dosen
            $id_dosen = $dosens[$nama] ?? null;

            // kalau tidak ada dosen → skip
            if (!$id_dosen) {
                continue;
            }

            //  insert (boleh berulang id_dosen)
            DB::table('penelitian_dosen')->insert([
                'id_dosen' => $id_dosen,
                'judul_penelitian' => $data['judul_penelitian'],
                'abstrak_penelitian' => $data['abstrak_penelitian'],
                'tahun_publikasi' => $data['tahun_publikasi'],
            ]);
        }

        fclose($file);
    }
}
