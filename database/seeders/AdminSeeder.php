<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $file = fopen(database_path('seeders/csv/admin.csv'), 'r');

        $header = fgetcsv($file);

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            $username = trim($data['username']);

            // 🔹 cek agar tidak duplicate
            $exists = DB::table('admin')
                ->where('username', $username)
                ->exists();

            if (!$exists) {
                DB::table('admin')->insert([
                    'username' => $username,
                    'password' => bcrypt($data['password']), //  penting untuk keamanan
                ]);
            }
        }

        fclose($file);
    }
}
