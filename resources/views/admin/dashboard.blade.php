@extends('template.template_admin')

@section('title', 'Dashboard Beranda')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'scrr-orange': '#F18F01',
                    }
                }
            }
        }
    </script>
@endpush

@section('content')
    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-[0_4px_12px_rgba(0,0,0,0.05)] border border-[#E5E7EB]">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Beranda</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Selamat datang kembali. Berikut merupakan update data terbaru.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    class="px-4 py-2.5 bg-white border border-gray-200 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm">
                    Tambah Dosen
                </button>
                <button
                    class="px-4 py-2.5 bg-[#D97706] text-white text-sm font-semibold rounded-xl hover:bg-amber-600 transition shadow-sm">
                    Tambah Mahasiswa
                </button>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalMahasiswa ?? 0 }}</h3>
                <p class="text-sm text-gray-500 mt-1">Total Mahasiswa</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalDosen ?? 0 }}</h3>
                <p class="text-sm text-gray-500 mt-1">Total Dosen</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalPenelitian ?? 0 }}</h3>
                <p class="text-sm text-gray-500 mt-1">Total Penelitian Dosen</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <h3 class="text-3xl font-bold text-gray-900">{{ $totalHistory ?? 0 }}</h3>
                <p class="text-sm text-gray-500 mt-1">Total Rekomendasi</p>
            </div>

        </div>

        {{-- CHART --}}
        <div class="bg-white p-6 rounded-2xl border shadow-sm mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-4">
                Perkembangan Rekomendasi Harian
            </h2>

            <canvas id="rekomendasiChart" height="100"></canvas>
        </div>

        {{-- TABLE + SIDEBAR (tetap dari desain kamu) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- TABLE --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border shadow-sm overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="font-bold text-gray-900">Aktivitas Terbaru</h2>
                    <a href="#" class="text-sm font-semibold text-blue-600">Tampilkan Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs uppercase text-gray-400 border-b">
                                <th class="px-6 py-4">Entity</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Prodi</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y text-sm">
                            @forelse ($aktivitasTerbaru as $item)
                                <tr class="hover:bg-gray-50 transition">

                                    {{-- NAMA --}}
                                    <td class="px-6 py-4 font-bold text-gray-900">
                                        {{ $item->mahasiswa->username ?? $item->nim_mahasiswa }}
                                    </td>

                                    {{-- ROLE --}}
                                    <td class="px-6 py-4 text-gray-500">
                                        Mahasiswa
                                    </td>

                                    {{-- TOPIK --}}
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ $item->topik }}
                                    </td>

                                    {{-- DATE --}}
                                    <td class="px-6 py-4 text-gray-500">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-400">
                                        Belum ada aktivitas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

    {{-- CHART SCRIPT --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('rekomendasiChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels ?? []) !!},
                    datasets: [{
                        label: 'Rekomendasi per Hari',
                        data: {!! json_encode($data ?? []) !!},
                        borderColor: '#F18F01',
                        backgroundColor: 'rgba(241, 143, 1, 0.2)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush

@endsection
