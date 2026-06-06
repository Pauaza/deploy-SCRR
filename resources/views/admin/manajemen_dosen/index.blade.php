@extends('template.template_admin')
@section('title', 'Manajemen Dosen')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    <div class="space-y-6 font-sans">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Manajemen Dosen
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Memantau dan mengelola data dosen.
                </p>
            </div>

            <a href="{{ route('admin.manajemen_dosen.create') }}"
                class="flex items-center justify-center px-5 py-2.5 bg-[#FFC107] text-white text-sm font-semibold rounded-lg hover:bg-yellow-500 transition-colors shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4 mr-2">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Tambah Dosen
            </a>
        </div>

        <!-- STATISTICS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- TOTAL DOSEN -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">

                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-users text-blue-600 text-xl"></i>
                </div>

                <h3 class="text-3xl font-bold text-gray-900">
                    {{ $totalDosen }}
                </h3>

                <p class="text-[10px] uppercase font-bold text-gray-500 mt-1 tracking-wider">
                    TOTAL DOSEN
                </p>
            </div>

            <!-- PENELITIAN -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">

                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-chart-line text-blue-600 text-xl"></i>
                </div>

                <h3 class="text-3xl font-bold text-gray-900">
                    {{ $totalPenelitian }}
                </h3>

                <p class="text-[10px] uppercase font-bold text-gray-500 mt-1 tracking-wider">
                    JUMLAH PENELITIAN
                </p>
            </div>

            <!-- LAB -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">

                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-lightbulb text-blue-600 text-xl"></i>
                </div>

                <h3 class="text-3xl font-bold text-gray-900">
                    {{ $totalLab }}
                </h3>

                <p class="text-[10px] uppercase font-bold text-gray-500 mt-1 tracking-wider">
                    LABORATORIUM
                </p>
            </div>

            <!-- SKRIPSI -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">

                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center mb-4">
                    <i class="fa-solid fa-graduation-cap text-blue-600 text-xl"></i>
                </div>

                <h3 class="text-3xl font-bold text-gray-900">
                    {{ $totalSkripsi }}
                </h3>

                <p class="text-[10px] uppercase font-bold text-gray-500 mt-1 tracking-wider">
                    BIMBINGAN ALUMNI
                </p>
            </div>
        </div>
        
        <!-- SEARCH BAR -->
        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
            <form method="GET" action="{{ route('admin.manajemen_dosen.index') }}" class="flex gap-3">

                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dosen..."
                    class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">

                <button type="submit"
                    class="px-5 py-2 bg-[#FFC107] text-white font-semibold rounded-lg hover:bg-yellow-500 transition">
                    Cari
                </button>

                @if (request('search'))
                    <a href="{{ route('admin.manajemen_dosen.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Reset
                    </a>
                @endif

            </form>
        </div>
        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full text-left border-collapse min-w-[900px]">

                    <thead>
                        <tr class="text-gray-400 text-xs uppercase tracking-wider border-b border-gray-100 bg-gray-50/30">

                            <th class="px-6 py-4 font-semibold">
                                ID
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Nama
                            </th>

                            <th class="px-6 py-4 font-semibold">
                                Laboratorium
                            </th>

                            <th class="px-6 py-4 font-semibold text-center">
                                Jumlah Penelitian
                            </th>

                            <th class="px-6 py-4 font-semibold text-center">
                                Jumlah Skripsi Alumni
                            </th>

                            <th class="px-6 py-4 font-semibold text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="text-sm divide-y divide-gray-50">

                        @forelse($dosen as $d)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <!-- ID -->
                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                    {{ $d->id_dosen }}
                                </td>

                                <!-- NAMA -->
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3 min-w-[220px]">

                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs shrink-0">
                                            {{ strtoupper(substr($d->nama_dosen, 0, 2)) }}
                                        </div>

                                        <div>
                                            <div class="font-bold text-gray-900">
                                                {{ $d->nama_dosen }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- LAB -->
                                <td class="px-6 py-4 whitespace-nowrap">

                                    <span
                                        class="px-3 py-1 bg-blue-50 text-blue-600 text-[11px] font-semibold rounded-full border border-blue-100">

                                        {{ $d->lab->nama_lab ?? '-' }}

                                    </span>
                                </td>

                                <!-- PENELITIAN -->
                                <td class="px-6 py-4 text-center font-bold text-gray-900">
                                    {{ $d->penelitian_count ?? 0 }}
                                </td>

                                <!-- SKRIPSI -->
                                <td class="px-6 py-4 text-center font-bold text-gray-900">
                                    {{ $d->jumlah_skripsi ?? 0 }}
                                </td>

                                <!-- ACTION -->
                                <td class="px-6 py-4 text-center">

                                    <div class="flex items-center justify-center gap-1.5">

                                        <!-- DETAIL -->
                                        <button type="button"
                                            onclick="openModal(
                                        '{{ $d->id_dosen }}',
                                        '{{ $d->nama_dosen }}',
                                        '{{ $d->lab->nama_lab ?? '-' }}',
                                        '{{ $d->penelitian_count ?? 0 }}',
                                        '{{ $d->jumlah_skripsi ?? 0 }}'
                                    )"
                                            class="text-gray-400 hover:text-yellow-600 mx-1">

                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>

                                        <!-- EDIT -->
                                        <a href="{{ route('admin.manajemen_dosen.edit', $d->id_dosen) }}"
                                            class="text-gray-400 hover:text-blue-600 mx-1">

                                            <i class="fa-solid fa-pen text-sm"></i>
                                        </a>

                                        <!-- DELETE -->
                                        <form id="delete-form-{{ $d->id_dosen }}"
                                            action="{{ route('admin.manajemen_dosen.destroy', $d->id_dosen) }}"
                                            method="POST" class="inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="button" onclick="confirmDelete('{{ $d->id_dosen }}')"
                                                class="text-gray-400 hover:text-red-600 mx-1">

                                                <i class="fa-solid fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">

                                    Tidak ada data dosen.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t border-gray-100">

                {{ $dosen->links() }}

            </div>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="detailModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">

        <div class="bg-white rounded-2xl p-6 w-full max-w-md">

            <div class="flex justify-between items-center mb-5">

                <h2 class="text-xl font-bold text-gray-900">
                    Detail Dosen
                </h2>

                <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 text-lg">

                    ✕
                </button>
            </div>

            <div class="space-y-4 text-sm">

                <div>
                    <p class="text-gray-500">
                        ID Dosen
                    </p>

                    <p id="modalId" class="font-semibold text-gray-900"></p>
                </div>

                <div>
                    <p class="text-gray-500">
                        Nama Dosen
                    </p>

                    <p id="modalNama" class="font-semibold text-gray-900"></p>
                </div>
                <div>
                    <p class="text-gray-500">
                        Laboratorium
                    </p>

                    <p id="modalLab" class="font-semibold text-gray-900"></p>
                </div>

                <div>
                    <p class="text-gray-500">
                        Jumlah Penelitian
                    </p>

                    <p id="modalPenelitian" class="font-semibold text-gray-900"></p>
                </div>

                <div>
                    <p class="text-gray-500">
                        Jumlah Skripsi Alumni
                    </p>

                    <p id="modalSkripsi" class="font-semibold text-gray-900"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function openModal(id, nama, lab, penelitian, skripsi) {

            document.getElementById('modalId').innerText = id;
            document.getElementById('modalNama').innerText = nama;
            document.getElementById('modalLab').innerText = lab;
            document.getElementById('modalPenelitian').innerText = penelitian;
            document.getElementById('modalSkripsi').innerText = skripsi;

            const modal = document.getElementById('detailModal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {

            const modal = document.getElementById('detailModal');

            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function confirmDelete(id) {

            Swal.fire({
                title: 'Hapus Data?',
                text: "Data dosen akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#FFC107',
                cancelButtonColor: '#d1d5db',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
@endsection
