@extends('template.template_user')

@section('title', 'Beranda_Mahasiswa')

@push('styles')
<!-- Tailwind khusus halaman ini -->
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

<style>
.content-area {
    background: radial-gradient(circle at top right, #FEF3C7 0%, #F9FBFF 40%) !important;
}

/* full tinggi */
.full-height {
    min-height: calc(100vh - 80px);
}
</style>
@endpush


@section('content')

<div class="flex flex-col lg:flex-row items-center justify-between full-height px-6 lg:px-12 gap-10">

    <!-- KIRI -->
   <div class="w-full lg:w-1/2 max-w-xl flex flex-col">

    <h1 class="text-5xl font-bold text-gray-800 leading-tight">
        Selamat Datang di Sistem 
        <span class="text-scrr-orange">
            Cerdas Rencana Riset (SCRR)
        </span>
    </h1>

    <!-- CARD MOBILE (TAMBAHAN BARU) -->
    <div class="block lg:hidden mt-6 flex justify-center">
        <div class="relative">

            <div class="absolute inset-0 bg-[#FDE68A] rounded-[2rem] 
                -translate-x-2 -translate-y-2 scale-105 -rotate-3"></div>

            <div class="relative bg-white border-2 border-white rounded-[2rem] p-4 shadow-sm z-10 flex items-center justify-center
                w-[280px] h-[210px] sm:w-[340px] sm:h-[260px]">

                <img src="{{ asset('assets/img/riset.jpg') }}"
                     class="w-full h-full object-contain">

            </div>

        </div>
    </div>

    <p class="text-gray-600 mt-6 text-lg max-w-xl leading-relaxed">
        Platform berbasis web yang membantu mahasiswa menentukan judul skripsi
        dan dosen pembimbing secara otomatis menggunakan metode Machine Learning.
    </p>

    <a href="{{ route('mahasiswa.rekomendasi') }}"
    class="mt-8 px-6 py-3 rounded-full text-white font-semibold shadow-lg 
    bg-gradient-to-r from-orange-400 to-orange-600 hover:scale-105 transition flex items-center gap-2 w-fit">
        
        Mulai Rekomendasi ✨
        <i class="fas fa-sparkles"></i>
    </a>

</div>

    <!-- KANAN -->
    <div class="w-full lg:w-1/2 hidden lg:flex justify-center shrink-0">

        <div class="relative">

             <!-- background efek -->
            <div class="absolute inset-0 bg-[#FDE68A] rounded-[2rem] 
                -translate-x-2 -translate-y-2 scale-105 -rotate-3"></div>

            <!-- CARD -->
            <div class="relative bg-white border-2 border-white rounded-[2rem] p-4 shadow-sm z-10 flex items-center justify-center
                w-[300px] h-[230px] sm:w-[360px] sm:h-[280px] lg:w-[420px] lg:h-[320px]">

                <img src="{{ asset('assets/img/riset.jpg') }}"
                     class="w-full h-full object-contain">

            </div>

        </div>

    </div>

</div>

@endsection