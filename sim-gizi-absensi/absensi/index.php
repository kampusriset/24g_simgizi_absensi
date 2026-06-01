<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require '../config/database.php';
require '../models/Absensi.php';

$db = (new Database())->connect();

$absensi = new Absensi($db);

// PAGINATION
$limit = 5;

$page = $_GET['page'] ?? 1;

$offset = ($page - 1) * $limit;

// SORTING
$sort = $_GET['sort'] ?? 'tanggal';

// DATA
$data = $absensi->getAll(
    $limit,
    $offset,
    $sort
);

// TOTAL DATA
$total = $absensi->count();

$totalPages = ceil($total / $limit);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Kelola Absensi</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
    rel="stylesheet">

    <style>

        body{
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfc;
        }

        .sidebar-link:hover,
        .sidebar-link.active{
            background-color: #f0fdf4;
            color: #059669;
        }

    </style>

</head>

<body class="flex min-h-screen text-slate-700">

    <!-- SIDEBAR -->
    <aside class="w-60 bg-white border-r border-gray-100 flex flex-col hidden md:flex">

        <div class="p-6 flex items-center gap-2">

            <div class="w-6 h-6 bg-[#059669] rounded flex items-center justify-center text-white text-[10px] font-bold italic">
                G
            </div>

            <span class="font-bold text-slate-800 tracking-tight text-sm">
                BADAN GIZI NASIONAL
            </span>

        </div>

        <nav class="flex-1 px-4 space-y-1">

            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.1em] px-3 mb-2 mt-4">
                Utama
            </p>

            <a
            href="../dashboard.php"
            class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] text-slate-400 hover:text-[#059669] transition-all">

                <svg class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2">

                    <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>

                </svg>

                Dashboard

            </a>

            <a
            href="index.php"
            class="sidebar-link active flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] transition-all">

                <svg class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2">

                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>

                </svg>

                Kelola Absensi

            </a>

        </nav>

        <div class="p-4 border-t border-gray-50">

            <a
            href="../auth/logout.php"
            class="flex items-center gap-2.5 px-3 py-2 rounded-lg font-bold text-[12px] text-red-500 hover:bg-red-50 transition-all">

                <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2">

                    <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>

                </svg>

                Log Out

            </a>

        </div>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-6 md:p-8 overflow-y-auto">

        <!-- HEADER -->
        <header class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-xl font-bold text-slate-900">
                    Kelola Absensi
                </h2>

                <p class="text-slate-400 text-[13px]">
                    Data absensi petugas Badan Gizi Nasional.
                </p>

            </div>

            <div class="flex items-center gap-3 bg-white p-1.5 pr-4 rounded-full border border-gray-100 shadow-sm">

                <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center text-white text-[10px] font-bold">

                    <?= substr($_SESSION['user'], 0, 2) ?>

                </div>

                <div>

                    <p class="text-[11px] font-bold text-slate-800 leading-none">

                        <?= $_SESSION['user'] ?>

                    </p>

                    <p class="text-[9px] font-bold text-emerald-600 uppercase mt-0.5">
                        Authorized User
                    </p>

                </div>

            </div>

        </header>

        <!-- CARD -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">

            <!-- TOP ACTION -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                <a
                href="tambah.php"
                class="bg-emerald-600 hover:bg-emerald-700 transition-all text-white text-sm font-semibold px-5 py-3 rounded-xl w-fit">

                    + Tambah Absensi

                </a>

                <div class="text-sm text-slate-500">

                    Sort :

                    <a
                    href="?sort=tanggal"
                    class="text-emerald-600 font-semibold hover:underline">

                        Tanggal

                    </a>

                    |

                    <a
                    href="?sort=status_hadir"
                    class="text-emerald-600 font-semibold hover:underline">

                        Status

                    </a>

                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-gray-100 text-left">

                            <th class="pb-4 text-[12px] uppercase tracking-wide text-slate-400">
                                Nama
                            </th>

                            <th class="pb-4 text-[12px] uppercase tracking-wide text-slate-400">
                                Tanggal
                            </th>

                            <th class="pb-4 text-[12px] uppercase tracking-wide text-slate-400">
                                Status
                            </th>

                            <th class="pb-4 text-[12px] uppercase tracking-wide text-slate-400">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php while($row = $data->fetch_assoc()): ?>

                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">

                            <td class="py-4 font-semibold text-sm text-slate-700">

                                <?= $row['nama'] ?>

                            </td>

                            <td class="py-4 text-sm text-slate-500">

                                <?= $row['tanggal'] ?>

                            </td>

                            <td class="py-4">

                                <?php if($row['status_hadir'] == 'Hadir'): ?>

                                    <span class="bg-emerald-50 text-emerald-600 text-[11px] font-bold px-3 py-1 rounded-full">

                                        Hadir

                                    </span>

                                <?php else: ?>

                                    <span class="bg-red-50 text-red-500 text-[11px] font-bold px-3 py-1 rounded-full">

                                        <?= $row['status_hadir'] ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="py-4 flex gap-2">

                                <a
                                href="edit.php?id=<?= $row['id_absensi'] ?>"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-bold px-4 py-2 rounded-lg transition-all">

                                    Edit

                                </a>

                                <a
                                href="hapus.php?id=<?= $row['id_absensi'] ?>"
                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-4 py-2 rounded-lg transition-all">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="flex flex-wrap justify-between items-center mt-6 gap-4">

                <a
                href="../dashboard.php"
                class="text-sm text-slate-500 hover:text-emerald-600 font-semibold">

                    ← Kembali ke Dashboard

                </a>

                <div class="flex gap-2">

                    <?php for($i = 1; $i <= $totalPages; $i++): ?>

                        <a
                        href="?page=<?= $i ?>&sort=<?= $sort ?>"
                        class="<?= ($i == $page)
                            ? 'bg-emerald-600 text-white'
                            : 'bg-white text-slate-500 border border-gray-200 hover:border-emerald-500 hover:text-emerald-600' ?>
                            w-9 h-9 rounded-lg flex items-center justify-center text-sm font-semibold transition-all">

                            <?= $i ?>

                        </a>

                    <?php endfor; ?>

                </div>

            </div>

        </div>

    </main>

</body>
</html>