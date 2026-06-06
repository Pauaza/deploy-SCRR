<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\PenelitianDosen;
use App\Models\SkripsiAlumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManajemenDosenController extends Controller
{
    public function index(Request $request)
    {
        $dosen = Dosen::with('lab')
            ->withCount('penelitian') // jumlah penelitian
            ->paginate(10);

        $query = Dosen::with(['lab'])
            ->withCount(['penelitian']);

        // hitung jumlah skripsi manual (karena 2 pembimbing)
        $dosen = Dosen::with('lab')
            ->withCount('penelitian')
            ->addSelect([
                'jumlah_skripsi' => DB::table('skripsi_alumni')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('id_pembimbing_1', 'dosen.id_dosen')
                    ->orWhereColumn('id_pembimbing_2', 'dosen.id_dosen')
            ])
            ->paginate(10);

        if ($request->search) {
            $query->where('nama_dosen', 'like', '%' . $request->search . '%');
        }
         $query->paginate(10);

        // CARD
        $totalDosen = Dosen::count();
        $totalPenelitian = \App\Models\PenelitianDosen::count();
        $totalLab = \App\Models\LabDosen::count();
        $totalSkripsi = \App\Models\SkripsiAlumni::count();

        return view('admin.manajemen_dosen.index', compact(
            'dosen',
            'totalDosen',
            'totalPenelitian',
            'totalLab',
            'totalSkripsi'
        ));
    }

    public function create()
    {
        return view('admin.manajemen_dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string|email',
            'laboratorium' => 'required|string',
            'bidang_keahlian' => 'required|string',
            'jumlah_penelitian' => 'required|numeric',
            'jumlah_skripsi_alumni' => 'required|numeric',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa email yang valid',
            'laboratorium.required' => 'Laboratorium wajib diisi',
            'bidang_keahlian.required' => 'Bidang Keahlian wajib diisi',
            'jumlah_penelitian.required' => 'Jumlah Penelitian wajib diisi',
            'jumlah_skripsi_alumni.required' => 'Jumlah Skripsi Alumni wajib diisi',
        ]);

        Dosen::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'laboratorium' => $request->laboratorium,
            'bidang_keahlian' => $request->bidang_keahlian,
            'jumlah_penelitian' => $request->jumlah_penelitian,
            'jumlah_skripsi_alumni' => $request->jumlah_skripsi_alumni,
        ]);

        return redirect()->route('admin.manajemen_dosen.index')
            ->with('success', 'Dosen berhasil dibuat.');
    }

    public function show($id)
    {
        $dosen = Dosen::find($id);

        return view('admin.manajemen_dosen.show', compact('dosen'));
    }

    public function edit($id)
    {
        $dosen = Dosen::find($id);

        return view('admin.manajemen_dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|string|email',
            'laboratorium' => 'required|string',
            'bidang_keahlian' => 'required|string',
            'jumlah_penelitian' => 'required|numeric',
            'jumlah_skripsi_alumni' => 'required|numeric',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus berupa email yang valid',
            'laboratorium.required' => 'Laboratorium wajib diisi',
            'bidang_keahlian.required' => 'Bidang Keahlian wajib diisi',
            'jumlah_penelitian.required' => 'Jumlah Penelitian wajib diisi',
            'jumlah_skripsi_alumni.required' => 'Jumlah Skripsi Alumni wajib diisi',
        ]);

        Dosen::find($id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'laboratorium' => $request->laboratorium,
            'bidang_keahlian' => $request->bidang_keahlian,
            'jumlah_penelitian' => $request->jumlah_penelitian,
            'jumlah_skripsi_alumni' => $request->jumlah_skripsi_alumni,
        ]);

        return redirect()->route('admin.manajemen_dosen.index')
            ->with('success', 'Dosen berhasil diubah.');
    }

    public function destroy($id_dosen)
    {
        Dosen::destroy($id_dosen);

        return redirect()->route('admin.manajemen_dosen.index')
            ->with('success', 'Dosen berhasil dihapus.');
    }

    // =================== PENELITIAN DOSEN ===================
    public function editPenelitian($id)
    {
        $dosen = Dosen::findOrFail($id);

        $penelitian = PenelitianDosen::where(
            'id_dosen',
            $id
        )->get();

        return view(
            'admin.manajemen_dosen.penelitian',
            compact('dosen', 'penelitian')
        );
    }

    public function storePenelitian(Request $request, $id)
    {
        $request->validate([
            'judul_penelitian' => 'required',
            'abstrak' => 'required',
            'tahun_publikasi' => 'required|numeric'
        ]);

        PenelitianDosen::create([
            'id_dosen' => $id,
            'judul_penelitian' => $request->judul_penelitian,
            'abstrak' => $request->abstrak,
            'tahun_publikasi' => $request->tahun_publikasi
        ]);

        return back()->with('success', 'Penelitian berhasil ditambahkan');
    }

    public function destroyPenelitian($id_penelitian)
    {
        PenelitianDosen::findOrFail($id_penelitian)
            ->delete();

        return back()
            ->with('success', 'Penelitian berhasil dihapus');
    }

    // =================== SKRIPSI ALUMNI ===================
    public function editSkripsi($id)
    {
        $dosen = Dosen::findOrFail($id);

        $skripsi = SkripsiAlumni::where('id_pembimbing_1', $id)
            ->orWhere('id_pembimbing_2', $id)
            ->get();

        return view(
            'admin.manajemen_dosen.skripsi',
            compact('dosen', 'skripsi')
        );
    }

    public function storeSkripsi(Request $request, $id)
    {
        $request->validate([
            'judul_skripsi' => 'required'
        ]);

        SkripsiAlumni::create([
            'judul_skripsi' => $request->judul_skripsi,
            'id_pembimbing_1' => $id
        ]);

        return back()
            ->with('success', 'Skripsi berhasil ditambahkan');
    }

    public function destroySkripsi($id_skripsi)
    {
        SkripsiAlumni::findOrFail($id_skripsi)
            ->delete();

        return back()
            ->with('success', 'Skripsi berhasil dihapus');
    }
}
