@extends('template.template_admin')

@section('title', 'Manajemen Mahasiswa')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="space-y-6 font-sans">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Mahasiswa</h1>
            <p class="text-sm text-gray-500 mt-1">Memantau dan mengelola data mahasiswa.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export
            </button>
            <a href="{{ route('admin.manajemen_mahasiswa.create') }}"
                class="flex items-center px-4 py-2 bg-[#FFC107] text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition-colors shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 mr-2"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4.5v15m7.5-7.5h-15" />

                </svg>

                Tambah Mahasiswa

            </a>
        </div>
    </div>

    {{-- Statistics Row --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 relative">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                <i class="fa-solid fa-users text-blue-600"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $totalMahasiswa }}</h3>
            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Total Mahasiswa</p>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                <i class="fa-solid fa-user-check text-blue-600"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $totalProdi }}</h3>
            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Total Prodi</p>
        </div>

        <!-- <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-clock-rotate-left text-blue-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">48</h3>
                <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Menunggu Verifikasi</p>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-graduation-cap text-blue-600"></i>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">400</h3>
                <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Akun Wisuda</p>
            </div> -->
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- {{-- Filter Bar --}}
            <div class="p-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="relative w-full md:w-48">
                        <select class="w-full bg-gray-50 border border-transparent text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 py-2 appearance-none cursor-pointer">
                            <option>All Study Programs</option>
                            <option>Sistem Informasi Bisnis</option>
                            <option>Teknik Informatika</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>
                    
                    <div class="relative w-full md:w-40">
                        <select class="w-full bg-gray-50 border border-transparent text-gray-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-3 py-2 appearance-none cursor-pointer">
                            <option>All Status</option>
                            <option>Active</option>
                            <option>Graduated</option>
                            <option>Pending</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>

                    <button class="text-blue-600 text-sm font-semibold hover:underline px-2">Clear Filters</button>
                </div>
            </div> -->

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase tracking-wider border-b border-gray-100 bg-gray-50/30">
                        <th class="px-6 py-4 font-semibold">NIM</th>
                        <th class="px-6 py-4 font-semibold">Username</th>
                        <th class="px-6 py-4 font-semibold text-center">Program Studi</th>
                        <th class="px-6 py-4 font-semibold text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-50">

                    @forelse ($mahasiswa as $mhs)
                    <tr class="hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $mhs->nim }}
                        </td>

                        <td class="px-6 py-4 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">
                                {{ strtoupper(substr($mhs->username, 0, 2)) }}
                            </div>
                            <span class="text-gray-900 font-medium">
                                {{ $mhs->username }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[11px] font-semibold rounded-full border border-blue-100">
                                {{ $mhs->prodi }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">

                            <div class="flex items-center justify-center gap-1.5">
                                {{-- DETAIL --}}
                                <button
                                    onclick="openModal('{{ $mhs->nim }}', '{{ $mhs->username }}', '{{ $mhs->prodi }}')"
                                    class="text-gray-400 hover:text-yellow-600 mx-1">

                                    <i class="fa-solid fa-eye text-sm"></i>

                                </button>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.manajemen_mahasiswa.edit', $mhs->nim) }}"
                                    class="text-gray-400 hover:text-blue-600 mx-1">
                                    <i class="fa-solid fa-pen text-sm"></i>
                                </a>

                                {{-- DELETE --}}
                                <form id="delete-form-{{ $mhs->nim }}"
                                    action="{{ route('admin.manajemen_mahasiswa.destroy', $mhs->nim) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button"
                                        onclick="confirmDelete(event, '{{ $mhs->nim }}')"
                                        class="text-gray-400 hover:text-red-600 mx-1">

                                        <i class="fa-solid fa-trash text-sm"></i>

                                    </button>

                                </form>

                            </div>

                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-400">
                            Tidak ada data mahasiswa
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


        {{-- Footer Table / Pagination --}}
        <div class="p-4 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
            <button class="text-blue-600 font-bold hover:text-blue-800 flex items-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                Import Bulk Data
            </button>

            <div class="flex items-center gap-6">
                <span class="text-gray-400 font-medium tracking-tight">
                    Page {{ $mahasiswa->currentPage() }} of {{ $mahasiswa->lastPage() }}
                </span>

                <div class="flex items-center gap-1.5">
                    @if ($mahasiswa->currentPage() > 1)
                    <a href="{{ $mahasiswa->url(1) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 transition-colors">
                        <i class="fa-solid fa-chevron-left text-[9px]"></i>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#FFC107] text-white font-bold shadow-sm">1</a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">2</a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">3</a>
                    <span class="w-8 h-8 flex items-center justify-center text-gray-300">...</span>
                    <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">129</a>
                    @endif
                </div>
                <div class="flex items-center border border-gray-100 rounded-lg overflow-hidden">
                    <button class="px-2 py-1.5 bg-white hover:bg-gray-50 border-r border-gray-100 text-gray-400 transition-colors"><i class="fa-solid fa-chevron-left text-[9px]"></i></button>
                    <button class="px-2 py-1.5 bg-white hover:bg-gray-50 text-gray-400 transition-colors"><i class="fa-solid fa-chevron-right text-[9px]"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="detailModal"
        class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

        <div class="bg-white rounded-2xl p-6 w-full max-w-md">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Detail Mahasiswa</h2>

                <button onclick="closeModal()" class="text-gray-500">
                    ✕
                </button>
            </div>

            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500">NIM</p>
                    <p id="modalNim" class="font-semibold"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Username</p>
                    <p id="modalUsername" class="font-semibold"></p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Prodi</p>
                    <p id="modalProdi" class="font-semibold"></p>
                </div>
            </div>

        </div>
    </div>
    <script>
        function openModal(nim, username, prodi) {
            document.getElementById('modalNim').innerText = nim;
            document.getElementById('modalUsername').innerText = username;
            document.getElementById('modalProdi').innerText = prodi;

            const modal = document.getElementById('detailModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>

    <script>
        function confirmDelete(event, nim) {
            event.preventDefault();

            Swal.fire({
                title: 'Hapus Data?',
                text: "Data mahasiswa akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FFC107',
                cancelButtonColor: '#d1d5db',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById(
                        'delete-form-' + nim
                    ).submit();

                }

            });
        }
    </script>

    @if(session('success'))

    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>

    @endif
</div>
@endsection