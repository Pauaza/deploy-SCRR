<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Cerdas Rencana Riset - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'scrr-orange': '#F18F01',
                        'scrr-bg-start': '#F9FBFF',
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: radial-gradient(circle at top right, #FEF3C7 0%, #F9FBFF 40%);
            background-color: #F9FBFF;
        }

        /* Border belakang yang miring sesuai UIUX */
        .bg-decorative {
            background-color: #FDE68A;
            /* yellow-200 */
            opacity: 1;
            transform: rotate(-3deg) scale(1.1);
            /* Miring sedikit ke arah berlawanan untuk estetik */
            border-radius: 2.5rem;
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center px-4 lg:px-8">

    <div class="flex flex-col lg:flex-row w-full max-w-5xl mx-auto items-center justify-center gap-6 lg:gap-10">

        <!-- KIRI -->
        <div class="w-full lg:w-1/2 flex flex-col items-center lg:items-start text-center lg:text-left lg:pl-16 lg:pr-6">
            <div class="mb-12">
                <h1 class="text-6xl font-bold leading-tight tracking-tight">
                    <span class="text-scrr-orange">Sistem Cerdas</span><br>
                    <span class="text-amber-300">Rencana Riset</span>
                </h1>

                <p class="text-gray-600 mt-3 text-xl max-w-md leading-relaxed">
                    Temukan Judul Skripsi dan Pembimbing yang Tepat untuk Memulai
                </p>
            </div>

            <div class="relative inline-block mt-1 mx-auto lg:mx-0">
                <div class="absolute inset-0 bg-decorative -translate-x-3 -translate-y-2"></div>

                <div class="relative bg-white border-2 border-white rounded-[2.5rem] p-6 shadow-sm z-10 overflow-hidden flex items-start justify-center pt-2"
                    style="width: 390px; height: 270px;">
                    <img src="{{ asset('assets/img/logo_jti.png') }}" alt="Logo JTI"
                        class="w-full h-full object-contain">
                </div>

                <div
                    class="absolute -bottom-6 -right-6 bg-scrr-orange hover:bg-orange-600 text-white text-xs font-medium px-6 py-4 rounded-3xl shadow-xl flex items-center gap-3 transition-all cursor-pointer z-20">
                    <div class="bg-white/20 p-1.5 rounded-lg">
                        <i class="fas fa-lightbulb text-lg"></i>
                    </div>
                    <span class="leading-tight font-semibold">
                        Mulai Perjalanan Skripsi<br>
                        <span class="text-[10px] font-normal opacity-90 uppercase tracking-wider">Anda dari Sini!</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- KANAN (LOGIN) -->
        <div class="w-full lg:w-1/2 flex justify-center mt-10 lg:mt-0">
            <div class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-md p-10">
                <h2 class="text-3xl font-bold text-gray-800 mb-8">Selamat Datang</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-xs font-medium text-gray-500 mb-1">MASUKKAN USERNAME</label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full px-4 py-3 bg-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-400"
                            placeholder="Masukkan username" required>
                    </div>

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-gray-400 mb-2 tracking-widest uppercase">
                            Masukkan Kata Sandi
                        </label>

                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="w-full px-6 py-4 bg-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-orange-300 text-sm"
                                placeholder="Masukkan kata sandi" required>

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400">
                                <i class="fas fa-eye text-sm" id="eye-icon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-scrr-orange hover:bg-orange-600 text-white font-bold text-lg shadow-lg">
                        Masuk
                    </button>
                </form>
            </div>
        </div>

    </div>

</body>

<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>
</body>

</html>
