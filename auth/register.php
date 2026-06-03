<?php
require '../config/database.php';
require '../models/User.php';

$db = (new Database())->connect();
$userModel = new User($db);

if ($_POST) {
    // Memanggil fungsi register tanpa parameter dapur
    $userModel->register(
        $_POST['nama'],
        $_POST['username'],
        $_POST['password'],
        $_POST['role']
    );

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIM Gizi Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .bg-illustration {
            background-image: url('https://images.unsplash.com/photo-1490818387583-1baba5e638af?q=80&w=1932&auto=format&fit=crop');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 md:p-10">

    <div class="flex w-full max-w-[1100px] h-full md:h-[680px] bg-white overflow-hidden md:rounded-[40px] shadow-xl border border-gray-100">
        
        <div class="w-full md:w-1/2 p-8 md:p-14 flex flex-col justify-center bg-white">
            <div class="flex items-center gap-2 mb-8 text-[#059669]">
                <div class="w-7 h-7 bg-[#059669] rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-extrabold text-slate-800 tracking-tight text-lg">SIM-GIZI</span>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">
                    Buat Akun<br> 
                    <span class="text-[#059669]">Bergabung Sekarang.</span>
                </h1>
                <p class="text-slate-400 mt-2 text-sm font-medium">Lengkapi data akun untuk pengelolaan absensi penerima manfaat.</p>
            </div>

            <form method="POST" class="space-y-4">
                <input type="text" name="nama" placeholder="Nama Lengkap" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#059669] transition-all text-sm text-slate-700">

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="username" placeholder="Username" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#059669] transition-all text-sm text-slate-700">
                    
                    <input type="password" name="password" placeholder="Password" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#059669] transition-all text-sm text-slate-700">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-2 uppercase tracking-wide">Pilih Role</label>
                    <div class="relative">
                        <select name="role" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-3.5 focus:outline-none focus:border-[#059669] transition-all text-sm text-slate-700 appearance-none cursor-pointer">
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                            <option value="sekolah">Sekolah</option>
                            <option value="dapur">Dapur</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-[#059669] hover:bg-[#047857] text-white font-bold py-4 rounded-xl transition-all active:scale-[0.98] mt-4 shadow-md">
                    Register
                </button>
            </form>

            <p class="mt-8 text-xs text-slate-400 font-medium text-center">
                Already have an account? <a href="login.php" class="text-orange-500 font-bold hover:underline">Sign In</a>
            </p>
        </div>

        <div class="hidden md:block md:w-1/2 p-5">
            <div class="w-full h-full bg-illustration rounded-[30px] relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/40 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                <div class="absolute bottom-10 left-10 right-10 text-white">
                    <p class="text-xl font-bold italic leading-relaxed">"Sistem yang terorganisir adalah awal dari pelayanan gizi yang berkualitas."</p>
                    <div class="mt-4 flex gap-1.5">
                        <div class="w-1.5 h-1 bg-white/40 rounded-full"></div>
                        <div class="w-6 h-1 bg-white rounded-full"></div>
                        <div class="w-1.5 h-1 bg-white/40 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>