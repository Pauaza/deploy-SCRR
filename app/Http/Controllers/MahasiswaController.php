<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\History;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function beranda()
    {
        return view('mahasiswa.beranda_mahasiswa');
    }

    public function rekomendasi()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();

        // Ambil histori milik mahasiswa aktif untuk disuntikkan ke sidebar kanan layout
        $histories = History::where('nim_mahasiswa', $mahasiswa->nim)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mahasiswa.rekomendasi', compact('histories'));
    }

    public function hasil(Request $request)
    {
        $request->validate([
            'topik' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $topik = $request->input('topik');
        $deskripsi = $request->input('deskripsi');

        // 1. Ambil data dosen secara acak/random untuk simulasi kuesioner
        $allDosen = Dosen::inRandomOrder()->take(3)->get();

        $mahasiswaAktif = Auth::guard('mahasiswa')->user();
        $rekomendasiDosen = [];

        // 2. Buat skor simulasi seolah-olah hasil perhitungan SAW nyata
        foreach ($allDosen as $index => $dosen) {
            $rekomendasiDosen[] = [
                'id_dosen' => $dosen->id_dosen,
                'nama_dosen' => $dosen->nama_dosen,
                'id_lab' => $dosen->id_lab,
                'persentase' => rand(75, 95) . '.0' // Skor simulasi antara 75% - 95%
            ];
        }

        $top3Dosen = $rekomendasiDosen;

        // 3. Rekomendasi Judul Simulasi (Agar tidak perlu menembak Gemini API)
        $rekomendasiJudul = [
            "Analisis Kepuasan Pengguna Sistem Informasi Akademik Berbasis Web Menggunakan Metode TAM",
            "Pengembangan Sistem Informasi Rekomendasi Tugas Akhir Menggunakan Pendekatan Kombinasi AHP dan SAW",
            "Perancangan Dashboard Manajemen Data Penelitian Dosen Jurusan Teknologi Informasi Berbasis Vokasi"
        ];

        // 4. SIMPAN LOG DATA KE TABEL HISTORY (Sama seperti kemarin)
        History::create([
            'nim_mahasiswa' => $mahasiswaAktif ? $mahasiswaAktif->nim : '2341760063',
            'topik' => $topik,
            'deskripsi_ide' => $deskripsi,
            'hasil_rekomendasi' => [
                'judul' => $rekomendasiJudul,
                'dosenArr' => $top3Dosen
            ]
        ]);

        // Dummy array skor agar halaman detail_dosen tidak error saat diklik
        $scoresC1 = [0.8, 0.7, 0.6];
        $scoresC2 = [0.75, 0.65, 0.55];
        $idLabMahasiswa = $mahasiswaAktif ? $mahasiswaAktif->id_lab : null;

        return view('mahasiswa.hasil_rekomendasi', compact('topik', 'deskripsi', 'rekomendasiJudul', 'top3Dosen', 'idLabMahasiswa', 'scoresC1', 'scoresC2'));
    }

    public function detailHistory($id)
    {
        /** @var \App\Models\Mahasiswa $mahasiswa */
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $history = $mahasiswa->histories()->findOrFail($id);

        $rekomendasiJudul = $history->hasil_rekomendasi['judul'] ?? [];
        $rekomendasiDosen = $history->hasil_rekomendasi['dosen'] ?? [];

        return view('mahasiswa.detail_history', compact('history', 'rekomendasiJudul', 'rekomendasiDosen'));
    }

    public function detailDosen(Request $request, $id)
    {
        // Ambil data dosen beserta relasinya
        $dosen = Dosen::with(['lab', 'penelitian', 'skripsiPembimbing1', 'skripsiPembimbing2'])->findOrFail($id);

        // Tangkap nilai kriteria semantik dari parameter URL (default 0 jika diakses manual tanpa form)
        $c1 = $request->query('c1', 0); // Skor Riset SBERT
        $c2 = $request->query('c2', 0); // Skor Skripsi Bimbingan SBERT
        $c3 = $request->query('c3', 0); // Status Lab (1 atau 0)

        // Logika Otomatis Pembentukan Teks "Tentang Dosen" Berbasis Aturan Kompetensi
        $analisisKecocokan = "";

        if ($c1 < 0 || $c2 < 0) {
            // Jika diakses langsung tanpa melalui proses form rekomendasi
            $analisisKecocokan = "Dosen ini merupakan bagian dari tenaga pengajar program studi Sistem Informasi yang memiliki kepakaran di bidang " . ($dosen->lab->nama_lab ?? 'Teknologi Informasi') . ".";
        } else {
            $analisisKecocokan = "Berdasarkan hasil analisis mesin kecerdasan semantik (SBERT), " . $dosen->nama_dosen . " direkomendasikan untuk Anda karena ";

            // Kondisi 1: Riset Pribadi Dosen Sangat Relevan
            if ($c1 >= $c2 && $c1 > 0.4) {
                $analisisKecocokan .= "memiliki rekam jejak publikasi ilmiah pribadi yang sangat selaras dengan ide skripsi yang Anda ajukan. ";
            }
            // Kondisi 2: Histori Membimbing Alumni Sangat Relevan
            elseif ($c2 > $c1 && $c2 > 0.4) {
                $analisisKecocokan .= "memiliki portofolio bimbingan tugas akhir alumni yang sangat relevan dan linier dengan ruang lingkup topik Anda. ";
            }
            // Kondisi 3: Skor moderat/berimbang
            else {
                $analisisKecocokan .= "kombinasi riwayat penelitian dan portofolio bimbingan akademiknya mencakup metodologi serta objek studi yang Anda angkat. ";
            }

            // Kondisi Tambahan: Kesesuaian Laboratorium (C3)
            if ($c3 == 1) {
                $analisisKecocokan .= "Faktor kesesuaian ini diperkuat karena Anda berada di bawah payung rumpun keahlian laboratorium yang sama, yaitu Laboratorium " . ($dosen->lab->nama_lab ?? '-') . ".";
            }
        }

        return view('mahasiswa.dosen', compact('dosen', 'analisisKecocokan', 'c1', 'c2', 'c3'));
    }

    public function profile()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        return view('mahasiswa.profile', compact('mahasiswa'));
    }
}
