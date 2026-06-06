@extends('template.template_admin')

@section('title', 'Kelola Skripsi Alumni')

@push('styles')

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

<div class="space-y-6 font-sans">


{{-- HEADER --}}
<div class="flex items-center justify-between">

    <div>

        <h1 class="text-2xl font-bold text-gray-900">
            Kelola Skripsi Alumni
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambah dan hapus riwayat skripsi alumni.
        </p>

    </div>

    <a href="{{ route('admin.manajemen_dosen.edit',$dosen->id_dosen) }}"
        class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-semibold text-gray-700">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali

    </a>

</div>

{{-- INFO DOSEN --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

    <div class="flex items-center gap-4">

        <div class="w-14 h-14 rounded-full bg-green-100 text-green-600 flex items-center justify-center font-bold text-lg">

            {{ strtoupper(substr($dosen->nama_dosen,0,2)) }}

        </div>

        <div>

            <h2 class="font-bold text-lg">
                {{ $dosen->nama_dosen }}
            </h2>

            <p class="text-sm text-gray-500">
                {{ $dosen->lab->nama_lab ?? '-' }}
            </p>

        </div>

    </div>

</div>

{{-- FORM --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

    <h3 class="font-semibold text-gray-800 mb-4">
        Tambah Skripsi Baru
    </h3>

    <form method="POST"
        action="{{ route('admin.manajemen_dosen.skripsi.store',$dosen->id_dosen) }}">

        @csrf

        <div class="flex gap-3">

            <input type="text"
                name="judul_skripsi"
                class="flex-1 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-400 outline-none"
                placeholder="Masukkan judul skripsi">

            <button type="submit"
                class="px-5 bg-green-500 hover:bg-green-600 text-white rounded-xl font-semibold">

                <i class="fa-solid fa-plus mr-2"></i>
                Tambah

            </button>

        </div>

    </form>

</div>

{{-- TABLE --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">

    <div class="px-6 py-4 border-b">

        <h3 class="font-semibold text-gray-800">
            Daftar Skripsi
        </h3>

    </div>

    <table class="w-full">

        <thead class="bg-gray-50">

            <tr>

                <th class="text-left px-6 py-4 font-semibold text-gray-700">
                    Judul Skripsi
                </th>

                <th class="text-center px-6 py-4 w-32 font-semibold text-gray-700">
                    Aksi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($skripsi as $item)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-6 py-4">
                    {{ $item->judul_skripsi }}
                </td>

                <td class="px-6 py-4 text-center">

                    <form method="POST"
                        action="{{ route('admin.manajemen_dosen.skripsi.destroy',$item->id_skripsi) }}">

                        @csrf
                        @method('DELETE')

                        <button
                            onclick="return confirm('Hapus skripsi ini?')"
                            class="w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 text-red-600">

                            <i class="fa-solid fa-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="2"
                    class="text-center py-10 text-gray-400">

                    Belum ada data skripsi

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>


</div>

@endsection
