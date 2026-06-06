@extends('template.template_user')

@section('title', 'Profil Mahasiswa')

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

<style>
/* BACKGROUND */
.content-area {
    background: radial-gradient(circle at top right, #FEF3C7 0%, #F9FBFF 40%) !important;
}

.full-height {
    min-height: calc(100vh - 80px);
}
</style>
@endpush

@section('content')

<div class="full-height px-6 lg:px-12 py-10">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800">
            Profil 
            <span class="text-scrr-orange">
                Mahasiswa
            </span>
        </h1>

        <p class="text-gray-500 mt-2">
              Data diri mahasiswa pada sistem SCRR
        </p>

    </div>

    <!-- CARD PROFILE -->
    <div class="max-w-5xl">

        <div class="bg-white rounded-[2rem] shadow-sm p-8">

            <!-- DATA -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- NIM -->
                <div class="bg-[#FFF8E7] rounded-2xl p-5 border border-yellow-100">

                    <p class="text-sm text-gray-500 mb-2">
                        Nomor Induk Mahasiswa
                    </p>

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl bg-white
                            flex items-center justify-center shadow-sm">

                            <i class="fa-solid fa-id-card text-orange-500"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $mahasiswa->nim }}
                        </h3>

                    </div>

                </div>

                <!-- USERNAME -->
                <div class="bg-[#FFF8E7] rounded-2xl p-5 border border-yellow-100">

                    <p class="text-sm text-gray-500 mb-2">
                        Nama Mahasiswa
                    </p>

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl bg-white
                            flex items-center justify-center shadow-sm">

                            <i class="fa-solid fa-user text-orange-500"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $mahasiswa->username }}
                        </h3>

                    </div>

                </div>

                <!-- PRODI -->
                <div class="bg-[#FFF8E7] rounded-2xl p-5 border border-yellow-100 md:col-span-2">

                    <p class="text-sm text-gray-500 mb-2">
                        Program Studi
                    </p>

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl bg-white
                            flex items-center justify-center shadow-sm">

                            <i class="fa-solid fa-graduation-cap text-orange-500"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $mahasiswa->prodi }}
                        </h3>

                    </div>

                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10">

                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="px-6 py-3 rounded-full text-white font-semibold shadow-lg
                    bg-gradient-to-r from-orange-400 to-orange-600
                    hover:scale-105 transition flex items-center gap-2 w-fit">

                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Dashboard

                </a>

            </div>

        </div>

    </div>

</div>

@endsection