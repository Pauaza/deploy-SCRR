<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\PenelitianDosen;
use App\Models\History;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // total stat
        $totalMahasiswa = Mahasiswa::count();
        $totalDosen = Dosen::count();
        $totalPenelitian = PenelitianDosen::count();
        $totalHistory = History::count();

        // data chart (per hari)
        $chartData = History::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = $chartData->pluck('date');
        $data = $chartData->pluck('total');

        // aktivitas terbaru
        $aktivitasTerbaru = History::with('mahasiswa')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalDosen',
            'totalPenelitian',
            'totalHistory',
            'labels',
            'data',
            'aktivitasTerbaru'
        ));
    }
}