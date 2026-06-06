@extends('template.template_admin')

@section('title', 'Kelola Penelitian')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

    <div class="space-y-6 font-sans">

        
        {{-- HEADER --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Kelola Penelitian
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Tambah dan hapus riwayat penelitian dosen.
                </p>
            </div>

            <a href="{{ route('admin.manajemen_dosen.edit', $dosen->id_dosen) }}"
                class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-semibold text-gray-700">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>

        </div>

        {{-- INFO DOSEN --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">

                    {{ strtoupper(substr($dosen->nama_dosen, 0, 2)) }}

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
                Tambah Penelitian Baru
            </h3>

            <form method="POST" action="{{ route('admin.manajemen_dosen.penelitian.store', $dosen->id_dosen) }}">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-4 gap-3">

                    <div class="md:col-span-2">

                        <input type="text" name="judul_penelitian" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Masukkan judul penelitian">

                    </div>

                    <div>

                        <textarea name="abstrak" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3"
                            placeholder="Abstrak penelitian"></textarea>
                    </div>

                    <div>

                        <input type="number" name="tahun_publikasi" required min="2000" max="{{ date('Y') }}"
                            value="{{ date('Y') }}"
                            class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Tahun">

                    </div>


                    <div>

                        <button type="submit"
                            class="w-full px-5 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-xl font-semibold">

                            <i class="fa-solid fa-plus mr-2"></i>
                            Tambah

                        </button>

                    </div>

                </div>

            </form>

        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">


            <table class="w-full">

                <thead class="bg-gray-50">

                    <tr>

                        <th class="text-left px-6 py-4 font-semibold text-gray-700">
                            Judul Penelitian
                        </th>

                        <th class="text-center px-6 py-4 w-40 font-semibold text-gray-700">
                            Tahun Publikasi
                        </th>

                        <th class="text-center px-6 py-4 w-32 font-semibold text-gray-700">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>
                    @foreach ($penelitian as $item)
                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-6 py-4">
                                {{ $item->judul_penelitian }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-sm">
                                    {{ $item->tahun_publikasi }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">

                                <form action="{{ route('admin.manajemen_dosen.penelitian.destroy', $item->id_penelitian) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-10 h-10 rounded-lg bg-red-50 hover:bg-red-100 text-red-600">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
        

    </div>

@endsection
