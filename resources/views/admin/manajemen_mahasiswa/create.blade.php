@extends('template.template_admin')

@section('title', 'Tambah Mahasiswa')

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
                Tambah Mahasiswa
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Tambahkan data mahasiswa baru.
            </p>
        </div>

        <a href="{{ route('admin.manajemen_mahasiswa.index') }}"
           class="flex items-center gap-2 px-4 py-2 bg-gray-100
                  hover:bg-gray-200 rounded-xl text-sm font-semibold
                  text-gray-700 transition-colors">

            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

    </div>

    {{-- CARD --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">

        <form action="{{ route('admin.manajemen_mahasiswa.store') }}"
              method="POST"
              class="p-6 space-y-6">

            @csrf

            {{-- ERROR --}}
            @if ($errors->any())

                <div class="bg-red-50 border border-red-100 rounded-xl p-4">

                    <ul class="space-y-1 text-sm text-red-600">

                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            {{-- NIM --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    NIM
                </label>

                <input type="text"
                       name="nim"
                       value="{{ old('nim') }}"
                       class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

            </div>

            {{-- USERNAME --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Username
                </label>

                <input type="text"
                       name="username"
                       value="{{ old('username') }}"
                       class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

            </div>

            {{-- PRODI --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Program Studi
                </label>

                <select name="prodi"
                        class="w-full rounded-xl border border-gray-200
                               px-4 py-3 focus:outline-none
                               focus:ring-2 focus:ring-yellow-400">

                    <option value="">Pilih Program Studi</option>

                    <option value="D-IV Sistem Informasi Bisnis">
                        D-IV Sistem Informasi Bisnis
                    </option>

                    <option value="D-IV Teknik Informatika">
                        D-IV Teknik Informatika
                    </option>

                </select>

            </div>

            {{-- PASSWORD --}}
            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="w-full rounded-xl border border-gray-200
                              px-4 py-3 focus:outline-none
                              focus:ring-2 focus:ring-yellow-400">

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('admin.manajemen_mahasiswa.index') }}"
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
                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection