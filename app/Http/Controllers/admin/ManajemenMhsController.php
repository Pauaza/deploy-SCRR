<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenMhsController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10);
        $totalMahasiswa = Mahasiswa::count();
        $totalProdi = Mahasiswa::distinct('prodi')->count('prodi');

        return view('admin.manajemen_mahasiswa.index', compact('mahasiswa', 'totalMahasiswa', 'totalProdi'));
    }

    public function create()
    {
        return view('admin.manajemen_mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|string',
            'username' => 'required|string',
            'prodi' => 'required|string',
            'password' => 'required|string|min:8',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'username.required' => 'Username wajib diisi',
            'prodi.required' => 'Prodi wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'username' => $request->username,
            'prodi' => $request->prodi,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.manajemen_mahasiswa.index')
                          ->with('success', 'Mahasiswa berhasil dibuat.');
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

        return view('admin.manajemen_mahasiswa.show', compact('mahasiswa'));
    }

    public function edit($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

        return view('admin.manajemen_mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $nim)
    {
        $request->validate([
            'nim' => 'required|string',
            'username' => 'required|string',
            'prodi' => 'required|string',
            'password' => 'nullable|string|min:8',
        ], [
            'nim.required' => 'NIM wajib diisi',
            'username.required' => 'Username wajib diisi',
            'prodi.required' => 'Prodi wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $mahasiswa = Mahasiswa::find($nim);
        $mahasiswa->nim = $request->nim;
        $mahasiswa->username = $request->username;
        $mahasiswa->prodi = $request->prodi;
        if ($request->filled('password')) {
            $mahasiswa->password = bcrypt($request->password);
        }
        $mahasiswa->save();

        return redirect()->route('admin.manajemen_mahasiswa.index')
                          ->with('success', 'Mahasiswa berhasil diubah.');
    }
           
    public function destroy($nim)
    {
        Mahasiswa::destroy($nim);

        return redirect()->route('admin.manajemen_mahasiswa.index')
                          ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}