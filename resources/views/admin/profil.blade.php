@extends('template.template_admin')

@section('title', 'Pengaturan Akun')

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto py-8 font-sans">
        
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-[#8E4B10]">Akun</h1>
        </div>

        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_4px_20px_rgba(0,0,0,0.03)] mb-8 relative border border-gray-50">
            
            <button class="absolute top-8 right-8 w-12 h-12 bg-[#FFC107] hover:bg-yellow-500 rounded-full flex items-center justify-center text-gray-800 shadow-md transition-transform hover:scale-105">
                <i class="fa-solid fa-pen text-lg"></i>
            </button>

            <div class="flex items-center gap-3 mb-8">
                <i class="fa-regular fa-id-badge text-3xl text-gray-800"></i>
                <h2 class="text-2xl font-bold text-gray-900">Identitas</h2>
            </div>

            <div class="flex flex-col md:flex-row gap-10">
                
                <div class="flex flex-col items-start">
                    <div class="relative">
                        <div class="w-48 h-64 bg-[#E5E7EB] rounded-2xl overflow-hidden flex items-end justify-center pt-8">
                            <svg class="w-36 h-36 text-[#D1D5DB]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <button class="absolute -bottom-4 -right-4 px-5 py-2.5 bg-[#FFC107] hover:bg-yellow-500 text-gray-900 text-sm font-bold rounded-full shadow-md transition-colors whitespace-nowrap">
                            Edit Foto Profil
                        </button>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6 mt-4 md:mt-0">
                    
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nama</label>
                        <div class="px-5 py-3.5 bg-[#F9FAFB] rounded-xl text-gray-800 font-medium text-sm">
                            Mahasiswa JTI
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Email</label>
                        <div class="px-5 py-3.5 bg-[#F9FAFB] rounded-xl text-gray-800 font-medium text-sm">
                            mahasiswajti@gmail.com
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Prodi</label>
                        <div class="px-5 py-3.5 bg-[#F9FAFB] rounded-xl text-gray-800 font-medium text-sm">
                            D-IV Sistem Informasi Bisnis
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">NIM</label>
                        <div class="px-5 py-3.5 bg-[#F9FAFB] rounded-xl text-gray-800 font-medium text-sm">
                            2341760000
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-[2rem] p-8 md:p-10 shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-gray-50">
            
            <div class="flex items-center gap-3 mb-6">
                <i class="fa-solid fa-lock text-2xl text-gray-800"></i>
                <h2 class="text-2xl font-bold text-gray-900">Sistem</h2>
            </div>

            <div class="space-y-3">
                
                <a href="#" class="flex items-center justify-between p-5 rounded-2xl bg-[#F9FAFB] hover:bg-gray-100 transition-colors group">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">Dukungan</h3>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                </a>

                <a href="#" class="flex items-center justify-between p-5 rounded-2xl bg-[#F9FAFB] hover:bg-gray-100 transition-colors group">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">Kata Sandi</h3>
                        <p class="text-xs text-gray-500 mt-1">Terakhir diperbaharui 4 bulan lalu</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                </a>

                <a href="#" class="flex items-center justify-between p-5 rounded-2xl bg-[#F9FAFB] hover:bg-gray-100 transition-colors group">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">Verifikasi Dua Langkah</h3>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                </a>

                <a href="#" class="flex items-center justify-between p-5 rounded-2xl bg-[#F9FAFB] hover:bg-gray-100 transition-colors group">
                    <div>
                        <h3 class="font-bold text-gray-900 text-sm">Hapus Akun</h3>
                        <p class="text-xs text-gray-500 mt-1">Menghapus permanen akun dan data anda</p>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-gray-600 transition-colors"></i>
                </a>

            </div>
        </div>

    </div>
@endsection
