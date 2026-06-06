@extends('template.template_admin')

@section('title', 'Edit Dosen')

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
                    Edit Dosen
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Perbarui informasi data dosen.
                </p>
            </div>
            <a href="{{ route('admin.manajemen_dosen.index') }}"
                class="flex items-center gap-2 px-4 py-2 bg-gray-100
                  hover:bg-gray-200 rounded-xl text-sm font-semibold
                  text-gray-700 transition-colors">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- CARD HEADER --}}
            <div class="px-6 py-5 border-b border-gray-100">

                <div class="flex items-center gap-4">

                    <div
                        class="w-14 h-14 rounded-full bg-blue-100
                            text-blue-600 flex items-center justify-center
                            font-bold text-lg">

                        {{ strtoupper(substr($dosen->nama_dosen, 0, 2)) }}

                    </div>

                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            {{ $dosen->nama_dosen }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $dosen->lab->nama_lab ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.manajemen_dosen.update', $dosen->id_dosen) }}" method="POST"
                class="p-6 space-y-6">

                @csrf
                @method('PUT')

                {{-- ERROR --}}
                @if ($errors->any())

                    <div class="bg-red-50 border border-red-100
                            rounded-xl p-4">

                        <ul class="space-y-1 text-sm text-red-600">

                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif

                {{-- NIM --}}
                <div>

                    <label class="block text-sm font-semibold
                              text-gray-700 mb-2">

                        ID

                    </label>

                    <input type="text" name="id" value="{{ old('id', $dosen->id_dosen) }}"
                        class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

                </div>

                {{-- NAMA --}}
                <div>

                    <label class="block text-sm font-semibold
                              text-gray-700 mb-2">

                        Nama

                    </label>

                    <input type="text" name="nama" value="{{ old('nama', $dosen->nama_dosen) }}"
                        class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

                </div>

                {{-- LABORATORIUM --}}
                <div>

                    <label class="block text-sm font-semibold
                              text-gray-700 mb-2">

                        Laboratorium

                    </label>

                    <input type="text" name="laboratorium"
                        value="{{ old('laboratorium', $dosen->lab ? $dosen->lab->nama_lab : '') }}"
                        class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

                </div>

                {{-- PASSWORD --}}
                <div>

                    <label class="block text-sm font-semibold
                              text-gray-700 mb-2">

                        Password Baru

                    </label>

                    <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password"
                        class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

                </div>

                <div class="flex justify-end gap-3 pt-4">

                    <a href="{{ route('admin.manajemen_dosen.penelitian', $dosen->id_dosen) }}"
                        class="px-5 py-3 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold">
                        <i class="fa-solid fa-flask mr-2"></i>
                        Kelola Penelitian
                    </a>

                    <a href="{{ route('admin.manajemen_dosen.skripsi', $dosen->id_dosen) }}"
                        class="px-5 py-3 rounded-xl bg-green-500 hover:bg-green-600 text-white font-semibold">
                        <i class="fa-solid fa-book mr-2"></i>
                        Kelola Skripsi
                    </a>

                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3 pt-4">

                    <a href="{{ route('admin.manajemen_dosen.index') }}"
                        class="px-5 py-3 rounded-xl bg-gray-100
                          hover:bg-gray-200 text-gray-700
                          font-semibold transition-colors">

                        Batal

                    </a>

                    <button type="submit"
                        class="px-5 py-3 rounded-xl bg-[#FFC107]
                               hover:bg-yellow-500 text-white
                               font-semibold shadow-sm transition-colors">

                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>


        </div>

    </div>

@endsection
