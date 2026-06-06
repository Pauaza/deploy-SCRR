@extends('template.template_user')

@section('title', 'Rekomendasi Skripsi')

@push('styles')
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                'scrr-orange': '#F18F01',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            }
        }
    }
}
</script>

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

<div class="full-height px-12 pt-0 pb-10 font-sans flex justify-center items-start">

    <!-- FORM WRAPPER (BIAR TENGAH & FULL) -->
    <div class="w-full max-w-4xl">

        <!-- HEADER -->
        <h1 class="text-4xl font-bold text-gray-800">
            Mulai Rekomendasi
        </h1>

        <h2 class="text-4xl font-bold text-orange-500 mt-2">
            Skripsi Anda
        </h2>

        <p class="text-gray-600 mt-4 text-lg leading-relaxed max-w-2xl">
            Masukkan topik dan deskripsi skripsi Anda untuk mendapatkan rekomendasi judul dan dosen pembimbing.
        </p>

        <!-- FORM -->
        <form id="formRekomendasi" action="{{ route('mahasiswa.hasil_rekomendasi') }}" method="POST"
            class="mt-3 bg-white/80 backdrop-blur-md px-8 py-6 rounded-2xl shadow-md space-y-8">

            @csrf

            <!-- TOPIK -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Topik Skripsi
                </label>

                <input type="text" name="topik"
                       class="w-full px-5 py-4 rounded-xl bg-white border border-gray-200 
                              focus:outline-none focus:ring-2 focus:ring-orange-400"
                       placeholder="Contoh: Data Mining, AI, Machine Learning"
                       required>
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Ide
                </label>

                <textarea name="deskripsi"
                          class="w-full px-5 py-4 rounded-xl bg-white border border-gray-200 
                                 h-44 focus:outline-none focus:ring-2 focus:ring-orange-400"
                          placeholder="Jelaskan ide skripsi kamu..."
                          required></textarea>
            </div>

            <!-- BUTTON -->
            <div class="pt-2">
                <button type="submit" id="btnSubmit"
                        class="px-6 py-3 rounded-full text-white font-semibold 
                        bg-gradient-to-r from-orange-400 to-orange-600 hover:scale-105 transition">

                    Mulai Rekomendasi ✨
                </button>
            </div>

        </form>

        <!-- LOADING -->
        <div id="loadingBox"
            style="
                display:none;
                position:fixed;
                inset:0;
                background:rgba(15,23,42,0.45);
                backdrop-filter: blur(4px);
                z-index:9999;
                justify-content:center;
                align-items:center;
            ">

            <div style="
                background:white;
                width:420px;
                padding:40px;
                border-radius:24px;
                text-align:center;
                box-shadow:0 15px 40px rgba(0,0,0,0.15);
            ">

                <!-- SPINNER -->
                <div style="
                    width:60px;
                    height:60px;
                    border:6px solid #FED7AA;
                    border-top:6px solid #F97316;
                    border-radius:50%;
                    margin:auto;
                    animation:spin 1s linear infinite;
                "></div>

                <!-- TITLE -->
                <h2 style="
                    margin-top:25px;
                    font-size:22px;
                    font-weight:700;
                    color:#1F2937;
                ">
                    Menyiapkan Rekomendasi Skripsi
                </h2>

                <!-- DESC -->
                <p style="
                    margin-top:12px;
                    color:#6B7280;
                    font-size:15px;
                    line-height:1.7;
                ">
                    Sistem sedang menganalisis topik dan deskripsi skripsi Anda
                    untuk memberikan rekomendasi terbaik.
                </p>

            </div>
        </div>

        <style>
        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
        </style>

        <script>
        const form = document.getElementById("formRekomendasi");

        form.addEventListener("submit", function() {

            // tampilkan loading
            document.getElementById("loadingBox").style.display = "flex";

            // disable tombol
            document.getElementById("btnSubmit").disabled = true;

        });
        </script>

    </div>

</div>

@endsection