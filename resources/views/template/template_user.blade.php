<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCRR - @yield('title', 'Dashboard')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary-yellow: #FFC107;
            --sidebar-bg: #F8FAFC;
            --text-dark: #333333;
            --sidebar-w: 240px;
            --content-bg: #FFFFFF;
            --panel-bg: #FAF4EA;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--content-bg);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
            /* Mencegah munculnya scroll horizontal saat animasi */
        }

        /* ─────────────────────────────
            SIDEBAR KIRI
        ───────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            border-right: 1px solid #E2E8F0;
            display: flex;
            flex-direction: column;
            padding: 24px 16px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar-top {
            padding-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .sidebar-top img {
            width: 140px;
            height: auto;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 14px;
            font-weight: 500;
            border-radius: 12px;
            transition: 0.2s;
        }

        .nav-item i {
            width: 20px;
            font-size: 18px;
        }

        .nav-item:hover {
            background: #E2E8F0;
        }

        .nav-item.active {
            background: var(--primary-yellow);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }

        /* ─────────────────────────────
            FOOTER SIDEBAR
        ───────────────────────────── */
        .sidebar-footer {
            border-top: 1px solid #E2E8F0;
            padding-top: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            font-size: 12px;
        }

        .user-info .name {
            font-weight: bold;
        }

        .user-info .id {
            color: #888;
        }

        /* ─────────────────────────────
            MAIN AREA & KONTEN
        ───────────────────────────── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
            /* HAPUS 'width: 100%;' di sini agar halaman tidak meluber ke kanan */
        }

        .main-wrapper.full {
            margin-left: 0;
        }

        .content-area {
            flex: 1;
            padding: 40px 44px;
            background: #FFFFFF;
        }

        /* ─────────────────────────────
            HISTORY PANEL (Kanan)
        ───────────────────────────── */
        .history-panel {
            width: 210px;
            min-width: 210px;
            flex-shrink: 0;
            background: var(--panel-bg);
            border-left: 1px solid #EDE8DF;
            padding: 24px 16px;
            /* 👈 INI KUNCI UTAMANYA: Mengembalikan jarak kiri-kanan */
            display: flex;
            flex-direction: column;
            transition: margin-right 0.3s ease, opacity 0.3s ease;

            /* Tambahan agar panel selalu terlihat saat Anda men-scroll konten tengah */
            position: sticky;
            top: 0;
            height: 100vh;
        }

        .history-panel.collapsed {
            margin-right: -210px !important;
            min-width: 0 !important;
            padding: 0 !important;
            /* Hapus semua padding (atas, bawah, kiri, kanan) */
            margin: 0 !important;
            opacity: 0 !important;
            border: none !important;
            overflow: hidden !important;
            /* KUNCI UTAMA: Memaksa isi panel ikut terlipat */
        }

        /* ─────────────────────────────
            TOMBOL TOGGLE (KIRI & KANAN)
        ───────────────────────────── */
        .toggle-sidebar {
            position: fixed;
            top: 50%;
            left: 240px;
            transform: translateY(-50%);
            width: 26px;
            height: 60px;
            background: #FFFFFF;
            border: 1px solid #eee;
            border-left: none;
            border-radius: 0 10px 10px 0;
            cursor: pointer;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: left 0.3s ease;
        }

        /* PENAMBAHAN BARU: Memindahkan tombol ke dinding saat ditutup */
        .toggle-sidebar.collapsed {
            left: 0;
        }

        .toggle-history {
            position: fixed;
            top: 50%;
            right: 210px;
            transform: translateY(-50%);
            width: 26px;
            height: 60px;
            background: #FAF4EA;
            border: 1px solid #eee;
            border-right: none;
            border-radius: 10px 0 0 10px;
            cursor: pointer;
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: right 0.3s ease;
        }

        /* PENAMBAHAN BARU: Memindahkan tombol ke dinding saat ditutup */
        .toggle-history.collapsed {
            right: 0;
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="sidebar-top">
            <img src="{{ asset('assets/img/logo_jti.png') }}" alt="SCRR Logo">
        </div>

        <nav class="nav-group">
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="nav-item {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>

            <a href="{{ route('mahasiswa.rekomendasi') }}"
                class="nav-item {{ request()->routeIs('mahasiswa.rekomendasi') || request()->routeIs('mahasiswa.hasil_rekomendasi') || request()->routeIs('dosen.show') ? 'active' : '' }}">
                <i class="fa-solid fa-lightbulb"></i>
                <span>Rekomendasi</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="avatar" style="width: 40px; height: 40px;">
                <i class="fa-solid fa-circle-user" style="font-size: 40px;"></i>
            </div>
            <div class="user-info">
                <span class="name">{{ Auth::user()->name ?? 'Mahasiswa' }}</span>
                <span class="id">{{ Auth::user()->username ?? '12345678' }}</span>
            </div>
            <button onclick="toggleDropdown()" style="margin-left: auto; cursor: pointer;"
                class="w-9 h-9 rounded-lg hover:bg-gray-100 transition flex items-center justify-center">

                <i class="fa-solid fa-gear text-gray-600"></i>
            </button>
            {{-- Popup Dropdown --}}
            <div id="dropdownMenu"
                class="hidden absolute bottom-14 right-0 w-40 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50">

                <a href="{{ route('mahasiswa.profile') }}"
                    class="w-full text-left px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 flex items-center gap-2 transition block">

                    <i class="fa-solid fa-user"></i>
                    Lihat Profil
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="w-full text-left px-4 py-3 text-sm text-red-500 hover:bg-red-50 flex items-center gap-2 transition">

                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout

                    </button>

                </form>

            </div>

        </div>

        <script>
            function toggleDropdown() {
                const menu = document.getElementById('dropdownMenu');
                menu.classList.toggle('hidden');
            }

            // Klik luar dropdown = tutup popup
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('dropdownMenu');

                if (!event.target.closest('.sidebar-footer')) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
        </div>
    </aside>

    <div class="main-wrapper">
        {{-- Tombol Toggle Sidebar --}}
        <button class="toggle-sidebar" id="toggleSidebar">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <main class="content-area">
            @yield('content')
        </main>

        {{-- Tombol Toggle History Panel --}}
        <button class="toggle-history" id="toggleHistory">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        {{-- HISTORY PANEL (Kanan) --}}
        <aside class="history-panel flex flex-col overflow-hidden">
            {{-- Header Sidebar Kanan --}}
            <div class="flex items-center justify-between pb-3 border-b border-gray-200/60 mb-4 mt-2">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-[#FFC107]"></i> Histori
                </h3>
            </div>

            {{-- List Histori (Scrollable) --}}
            <div class="history-list flex-1 overflow-y-auto pr-1 pb-20 space-y-3 custom-scrollbar">
                @if (isset($histories) && $histories->count() > 0)
                    @foreach ($histories as $item)
                        <button type="button" onclick="window.openHistoryModal({{ $item->id }})"
                            class="group relative w-full text-left bg-white p-3 rounded-xl border border-gray-100 shadow-sm hover:shadow-md hover:border-orange-200 transition-all duration-300 cursor-pointer overflow-hidden flex flex-col gap-1.5">

                            {{-- Aksen Garis Kiri saat Hover --}}
                            <div
                                class="absolute left-0 top-0 bottom-0 w-1 bg-orange-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>

                            {{-- Judul Topik --}}
                            <span
                                class="text-xs font-semibold text-gray-700 group-hover:text-orange-600 line-clamp-2 leading-snug">
                                {{ $item->topik }}
                            </span>

                            {{-- Tanggal / Waktu --}}
                            <span class="text-[10px] text-gray-400 font-medium flex items-center gap-1.5 mt-1">
                                <i class="fa-regular fa-calendar-days"></i>
                                {{ $item->created_at ? $item->created_at->format('d M Y') : 'Baru saja' }}
                            </span>
                        </button>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center text-center py-10 px-2 opacity-60">
                        <i class="fa-solid fa-inbox text-3xl text-gray-300 mb-2"></i>
                        <span class="text-xs text-gray-500 font-medium">Belum ada histori<br>rekomendasi.</span>
                    </div>
                @endif
            </div>
        </aside>

        {{-- MODAL CONTAINER UNTUK HISTORY --}}
        @if (isset($histories) && $histories->count() > 0)
            @foreach ($histories as $item)
                <div id="modal-history-{{ $item->id }}"
                    class="hidden fixed inset-0 bg-slate-950/40 backdrop-blur-xs z-[9999] flex items-center justify-center p-4 transition-all duration-300">

                    {{-- Card Box Modal --}}
                    <div
                        class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[85vh] flex flex-col overflow-hidden relative border border-gray-100 text-left scale-95 transition-transform duration-300">

                        {{-- Tombol Tutup (X) di Sudut Atas --}}
                        <button onclick="closeHistoryModal({{ $item->id }})"
                            class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 transition duration-200 z-50">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>

                        {{-- Bagian Kepala Modal (Header) --}}
                        <div class="p-6 border-b border-gray-100 bg-slate-50/60 pr-12">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 mb-2">
                                <i class="fa-solid fa-clock-rotate-left mr-1.5"></i>
                                {{ $item->created_at ? $item->created_at->format('d M Y, H:i') : 'Baru saja' }}
                            </span>
                            <h3 class="text-base font-bold text-gray-900 leading-snug">
                                {{ $item->topik }}
                            </h3>
                        </div>

                        {{-- Bagian Isi Modal (Scrollable Content) --}}
                        <div class="p-6 overflow-y-auto space-y-5 flex-1 max-h-[calc(85vh-140px)]">

                            {{-- 🔥 AMANKAN DATA DARI CASTING ARRAY DI SINI (MUTLAK) --}}
                            @php
                                $rawRekomendasi = $item->hasil_rekomendasi;

                                // Proteksi jika data tertulis ganda sebagai string teks akibat cache lama
                                if (is_string($rawRekomendasi)) {
                                    $rawRekomendasi = json_decode($rawRekomendasi, true);
                                }

                                // Ekstraksi data secara presisi sesuai logika MahasiswaController
                                $listJudul = $rawRekomendasi['judul'] ?? [];

                                // Menangani pembacaan baik key baru (dosenArr) maupun key fallback (dosen)
                                $listDosen = $rawRekomendasi['dosenArr'] ?? ($rawRekomendasi['dosen'] ?? []);
                            @endphp

                            {{-- Deskripsi Ide --}}
                            <div>
                                <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5">
                                    Deskripsi Ide Penelitian
                                </h4>
                                <div
                                    class="bg-slate-50 border border-gray-200/50 p-4 rounded-xl text-sm text-gray-700 whitespace-pre-wrap leading-relaxed">
                                    {!! nl2br(e($item->deskripsi_ide)) !!}
                                </div>
                            </div>

                            {{-- Baris Grid Hasil API --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                {{-- Kolom Kiri: Hasil Rekomendasi Judul --}}
                                <div class="space-y-2">
                                    <h4
                                        class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                        <i class="fa-solid fa-book text-[#FFC107]"></i> Rekomendasi Judul
                                    </h4>

                                    @if (count($listJudul) > 0)
                                        <div class="space-y-1.5">
                                            @foreach ($listJudul as $judul)
                                                <div
                                                    class="p-3 bg-amber-50/40 border border-amber-100/60 rounded-xl text-xs text-gray-800 font-medium leading-normal shadow-2xs">
                                                    {{ $judul }}
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-xs text-gray-400 italic p-1">Tidak ada rekomendasi judul.</p>
                                    @endif
                                </div>

                                {{-- Kolom Kanan: Hasil Rekomendasi Dosen --}}
                                <div class="space-y-2">
                                    <h4
                                        class="text-[11px] font-bold text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                                        <i class="fa-solid fa-chalkboard-user text-[#FFC107]"></i> Rekomendasi Dosen
                                    </h4>

                                    {{-- 🔥 PERUBAHAN UTAMA: Membaca variabel $listDosen hasil parsing global di atas --}}
                                    @if (count($listDosen) > 0)
                                        <div class="space-y-1.5">
                                            @foreach ($listDosen as $dsn)
                                                <div
                                                    class="p-3 border border-gray-200/60 rounded-xl bg-white shadow-2xs flex items-center justify-between gap-2">
                                                    <div class="flex flex-col gap-0.5">
                                                        <span class="font-bold text-xs text-gray-800">
                                                            {{-- Support multi-key parsing data lama/baru --}}
                                                            {{ $dsn['nama_dosen'] ?? ($dsn['nama'] ?? ($dsn['Nama_Dosen'] ?? 'Nama Dosen')) }}
                                                        </span>
                                                        <span class="text-[10px] text-gray-400 font-medium">
                                                            <i class="fa-solid fa-id-card mr-1"></i> ID Dosen:
                                                            {{ $dsn['id_dosen'] ?? ($dsn['Id_Dosen'] ?? '-') }}
                                                        </span>
                                                    </div>

                                                    <div
                                                        class="bg-amber-100 text-amber-900 font-bold text-[11px] px-2 py-1 rounded-md shrink-0">
                                                        {{ $dsn['persentase'] ?? ($dsn['Persentase'] ?? ($dsn['Skor_AS'] ?? '0')) }}%
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-xs text-gray-400 italic p-1">Tidak ada rekomendasi dosen.</p>
                                    @endif
                                </div>

                            </div>
                        </div>

                        {{-- Bagian Kaki Modal (Footer) --}}
                        <div class="p-4 border-t border-gray-100 bg-slate-50 flex justify-end">
                            <button onclick="closeHistoryModal({{ $item->id }})"
                                class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl text-xs font-semibold transition duration-200 cursor-pointer">
                                Tutup
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif

        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sidebar = document.querySelector('.sidebar');
                    const historyPanel = document.querySelector('.history-panel');
                    const mainWrapper = document.querySelector('.main-wrapper');

                    const toggleSidebar = document.getElementById('toggleSidebar');
                    const toggleHistory = document.getElementById('toggleHistory');

                    // SIDEBAR TOGGLE
                    // TOGGLE KIRI
                    toggleSidebar.addEventListener('click', () => {
                        sidebar.classList.toggle('collapsed');
                        mainWrapper.classList.toggle('full'); // Menyesuaikan margin konten
                        toggleSidebar.classList.toggle('collapsed'); // Memindahkan tombol

                        const icon = toggleSidebar.querySelector('i');
                        icon.classList.toggle('fa-chevron-left');
                        icon.classList.toggle('fa-chevron-right');
                    });

                    // TOGGLE KANAN
                    toggleHistory.addEventListener('click', () => {
                        historyPanel.classList.toggle('collapsed'); // Menyusutkan sidebar kanan
                        toggleHistory.classList.toggle('collapsed'); // Memindahkan tombol

                        toggleHistory.style.right = '';

                        const icon = toggleHistory.querySelector('i');
                        icon.classList.toggle('fa-chevron-right');
                        icon.classList.toggle('fa-chevron-left');
                    });
                });

                // FUNGSI UNTUK MEMBUKA MODAL HISTORI
                function openHistoryModal(id) {
                    const modal = document.getElementById(`modal-history-${id}`);
                    if (modal) {
                        modal.classList.remove('hidden');
                        // Kunci scrolling pada halaman utama saat modal terbuka
                        document.body.style.overflow = 'hidden';

                        // Animasi pop-up terasa lebih halus
                        setTimeout(() => {
                            modal.firstElementChild.classList.remove('scale-95');
                            modal.firstElementChild.classList.add('scale-100');
                        }, 10);
                    }
                }

                // FUNGSI UNTUK MENUTUP MODAL HISTORI
                function closeHistoryModal(id) {
                    const modal = document.getElementById(`modal-history-${id}`);
                    if (modal) {
                        modal.firstElementChild.classList.remove('scale-100');
                        modal.firstElementChild.classList.add('scale-95');

                        setTimeout(() => {
                            modal.classList.add('hidden');
                            // Kembalikan scrolling halaman utama
                            document.body.style.overflow = '';
                        }, 150);
                    }
                }

                // Klik area luar modal kartu otomatis akan menutup modal
                document.addEventListener('click', function(event) {
                    if (event.target.id.startsWith('modal-history-')) {
                        const id = event.target.id.replace('modal-history-', '');
                        closeHistoryModal(id);
                    }
                });
            </script>
        @endpush
        @stack('scripts')
</body>

</html>
