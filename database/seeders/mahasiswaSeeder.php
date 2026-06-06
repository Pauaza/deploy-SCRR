<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/mahasiswa.csv'), 'r');

        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            $nim = trim($data['NIM']);
            $username = trim($data['username']);

            // 🔹 cek agar tidak duplicate (berdasarkan NIM)
            $exists = DB::table('mahasiswa')
                ->where('NIM', $nim)
                ->exists();

            if (!$exists) {
                DB::table('mahasiswa')->insert([
                    'NIM' => $nim,
                    'username' => $username,
                    'password' => bcrypt($data['password']), //  hash password
                ]);
            }
        }

        fclose($file);
    }
}
