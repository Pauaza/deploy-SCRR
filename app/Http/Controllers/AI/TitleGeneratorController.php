<?php

namespace App\Http\Controllers\AI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TitleGeneratorController extends Controller
{
    // Menampilkan halaman form input
    public function index()
    {
        return view('ai.form_judul');
    }

    // Memproses input dan menembak API Python di Port 8001
    public function generate(Request $request)
    {
        // Validasi input form
        $request->validate([
            'topik' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        // Tembak API Python FastAPI yang berjalan di port 8001
        $response = Http::post('[http://127.0.0.1:8001/api/generate-titles](http://127.0.0.1:8001/api/generate-titles)', [
            'topik' => $request->topik,
            'deskripsi' => $request->deskripsi,
        ]);

        $rekomendasiJudul = [];
        if ($response->successful()) {
            $rekomendasiJudul = $response->json()['judul'] ?? [];
        } else {
            $rekomendasiJudul = [
                'Gagal terhubung ke AI Engine.',
                'Pastikan server Uvicorn Python di port 8001 sudah dinyalakan.',
                'Periksa kembali konfigurasi API Key Gemini Anda.'
            ];
        }

        // Kembalikan ke halaman view hasil membawa data judul
        return view('ai.hasil_judul', [
            'topik' => $request->topik,
            'deskripsi' => $request->deskripsi,
            'rekomendasiJudul' => $rekomendasiJudul
        ]);
    }
}