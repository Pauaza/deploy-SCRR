<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(database_path('seeders/csv/lab_dosen.csv'), 'r');

        $header = fgetcsv($file); // ambil header CSV

        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

        $lab = DB::table('lab_dosen')
            ->where('nama_lab', $data['nama_lab'])
            ->first();

        if (!$lab) {
            $id = DB::table('lab_dosen')->insertGetId([
                'nama_lab' => $data['nama_lab'],
            ]);
        } else {
            $id = $lab->id_lab;
        }
        }

        fclose($file);
    }
    }

