@extends('template.template_user')

@section('title', 'Detail Dosen')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>

<style>
.content-area {
    background: radial-gradient(circle at top right, #FEF3C7 0%, #F9FBFF 40%) !important;
}

.full-height {
    min-height: calc(100vh - 80px);
}
</style>
@endpush

@section('content')

<div class="full-height px-10 pt-4 pb-10 font-sans">

    <div class="max-w-5xl mx-auto">

        <!-- HEADER DOSEN -->
<div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-md p-10 border border-gray-100">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">
                {{ $dosen->nama_dosen }}
            </h1>
            <p class="mt-3 text-orange-500 font-semibold text-lg">
                <i class="fa-solid fa-flask mr-1"></i> Laboratorium: {{ $dosen->lab->nama_lab ?? 'Lab belum tersedia' }}
            </p>
        </div>
        <div class="bg-yellow-400 px-6 py-4 rounded-2xl text-xl font-bold shadow flex flex-col items-center">
            <span class="text-xs uppercase tracking-wider opacity-70">Rekomendasi</span>
            <span>SAW Approved</span>
        </div>
    </div>

    <div class="mt-8 pt-6 border-t border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-orange-500"></i> Analisis Justifikasi Kelayakan
        </h2>
        <p class="text-gray-600 leading-relaxed text-justify bg-orange-50/40 p-4 rounded-xl border border-orange-100/30 italic">
            "{{ $analisisKecocokan }}"
        </p>
    </div>

    {{-- 💡 VISUALISASI BADGE METRIK EVALUASI (TAMBAHAN PREMIUM) --}}
    @if(request()->has('c1'))
    <div class="mt-6 grid grid-cols-3 gap-4 pt-4">
        <div class="bg-slate-50 p-3 rounded-xl border border-gray-100 text-center">
            <span class="block text-[10px] font-bold text-gray-400 uppercase">Kesesuaian Riset</span>
            <span class="text-lg font-bold text-slate-700">{{ round($c1 * 100, 1) }}%</span>
        </div>
        <div class="bg-slate-50 p-3 rounded-xl border border-gray-100 text-center">
            <span class="block text-[10px] font-bold text-gray-400 uppercase">Kesesuaian Bimbingan</span>
            <span class="text-lg font-bold text-slate-700">{{ round($c2 * 100, 1) }}%</span>
        </div>
        <div class="bg-slate-50 p-3 rounded-xl border border-gray-100 text-center">
            <span class="block text-[10px] font-bold text-gray-400 uppercase">Afiliasi Lab</span>
            <span class="text-lg font-bold {{ $c3 == 1 ? 'text-emerald-600' : 'text-gray-400' }}">
                {{ $c3 == 1 ? 'Sesuai (1.0)' : 'Berbeda (0.0)' }}
            </span>
        </div>
    </div>
    @endif
</div>

        <!-- PENELITIAN -->
        <div class="mt-10">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-2xl font-bold text-gray-800">
                    Riwayat Penelitian
                </h2>

                <span class="text-sm text-gray-500">
                    {{ $dosen->penelitian->count() }} Penelitian
                </span>

            </div>

            <div class="space-y-5">

                @forelse($dosen->penelitian as $item)

                    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-md p-7 border border-gray-100">

                        <div class="flex justify-between items-start gap-4">

                            <div>
                                <h3 class="text-xl font-bold text-gray-800 leading-relaxed">
                                    {{ $item->judul_penelitian }}
                                </h3>

                                <p class="text-orange-500 text-sm mt-2 font-medium">
                                    Tahun Publikasi: {{ $item->tahun_publikasi }}
                                </p>
                            </div>

                            <div class="bg-orange-100 text-orange-600 px-4 py-2 rounded-xl text-sm font-semibold">
                                Penelitian
                            </div>

                        </div>

                        <div class="mt-5">
                            <p class="text-gray-600 leading-relaxed text-justify">
                                {{ $item->abstrak_penelitian }}
                            </p>
                        </div>

                    </div>

                @empty

                    <div class="bg-white rounded-2xl shadow-md p-8 text-center text-gray-500">

                        <i class="fa-solid fa-folder-open text-4xl mb-4 text-orange-300"></i>

                        <p>
                            Belum ada data penelitian dosen.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

        <!-- BUTTON -->
        <div class="mt-10">

            <button onclick="history.back()"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-full 
                    bg-gradient-to-r from-orange-400 to-orange-600 
                    text-white font-semibold hover:scale-105 transition">

                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Rekomendasi

            </button>

        </div>

    </div>

</div>

@endsection