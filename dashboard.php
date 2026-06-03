<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIM Gizi Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
        .sidebar-link:hover, .sidebar-link.active { background-color: #f0fdf4; color: #059669; }
    </style>
</head>
<body class="flex min-h-screen text-slate-700">

    <aside class="w-60 bg-white border-r border-gray-100 flex flex-col hidden md:flex">
        <div class="p-6 flex items-center gap-2">
            <div class="w-6 h-6 bg-[#059669] rounded flex items-center justify-center text-white text-[10px] font-bold italic">G</div>
            <span class="font-bold text-slate-800 tracking-tight text-sm">BADAN GIZI NASIONAL</span>
        </div>

        <nav class="flex-1 px-4 space-y-1">
            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.1em] px-3 mb-2 mt-4">Utama</p>
            
            <a href="dashboard.php" class="sidebar-link active flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <a href="absensi/index.php" class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] text-slate-400 hover:text-[#059669] transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Kelola Absensi
            </a>
        </nav>

        <div class="p-4 border-t border-gray-50">
            <a href="auth/logout.php" class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-bold text-[12px] text-red-500 hover:bg-red-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Log Out
            </a>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-8 overflow-y-auto">
        <header class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Selamat Datang, <?= $_SESSION['user'] ?>!</h2>
                <p class="text-slate-400 text-[13px]">Lakukan Absensi tepat waktu.</p>
            </div>
            
            <div class="flex items-center gap-3 bg-white p-1.5 pr-4 rounded-full border border-gray-100 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-white text-[10px] font-bold">
                    <?= substr($_SESSION['user'], 0, 2) ?>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-800 leading-none"><?= $_SESSION['user'] ?></p>
                    <p class="text-[9px] font-bold text-emerald-600 uppercase mt-0.5">Authorized User</p>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Status Koneksi</p>
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></div>
                    <h3 class="text-sm font-bold text-slate-800 tracking-tight">Database Active</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-2">Total Fitur</p>
                <h3 class="text-sm font-bold text-slate-800">SIM-GIZI v1.0</h3>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-wider mb-1">Aksi Cepat</p>
                    <a href="absensi/index.php" class="text-[12px] font-bold text-emerald-600 hover:underline italic">Input Absensi →</a>
                </div>
                <a href="absensi/index.php" class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                        <path d="M12 4v16m8-8H4"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="bg-emerald-600 rounded-2xl p-8 text-white relative overflow-hidden shadow-lg shadow-emerald-100">
            <div class="relative z-10 max-w-lg">
                <h3 class="text-lg font-bold mb-1 italic opacity-90">Project Informatics 2026</h3>
                <p class="text-[12px] text-emerald-50 leading-relaxed opacity-80">
                    Sistem ini dirancang untuk mempermudah Petugas Badan Gizi Nasional untuk absensi secara digital dan efisien.
                </p>
            </div>
            <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-emerald-500 rounded-full opacity-30"></div>
        </div>

    </main>
</body>
</html>