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

// DATA PENERIMA
$penerima = $absensi->getPenerima();

// DATA ABSENSI
$data = $absensi->getById($_GET['id']);

// UPDATE
if ($_POST) {

    $absensi->update(
        $_GET['id'],
        $_POST['id_penerima'],
        $_POST['tanggal'],
        $_POST['status_hadir']
    );

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Edit Absensi</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
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

            <!-- DASHBOARD -->
            <a
            href="../dashboard.php"
            class="sidebar-link flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] text-slate-400 hover:text-[#059669] transition-all">

                <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2">

                    <path d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>

                </svg>

                Dashboard

            </a>

            <!-- ABSENSI -->
            <a
            href="index.php"
            class="sidebar-link active flex items-center gap-2.5 px-3 py-2 rounded-lg font-semibold text-[13px] transition-all">

                <svg
                class="w-4 h-4"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2">

                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>

                </svg>

                Kelola Absensi

            </a>

        </nav>

        <!-- LOGOUT -->
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
                    Edit Absensi
                </h2>

                <p class="text-slate-400 text-[13px]">
                    Ubah data absensi petugas.
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

        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 max-w-2xl">

            <form method="POST" class="space-y-5">

                <!-- PENERIMA -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Nama Penerima
                    </label>

                    <select
                    name="id_penerima"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">

                        <?php while($row = $penerima->fetch_assoc()): ?>

                            <option
                            value="<?= $row['id_penerima'] ?>"

                            <?php
                            if($row['id_penerima']
                            == $data['id_penerima']) {
                                echo "selected";
                            }
                            ?>>

                                <?= $row['nama'] ?>

                            </option>

                        <?php endwhile; ?>

                    </select>

                </div>

                <!-- TANGGAL -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Tanggal
                    </label>

                    <input
                    type="date"
                    name="tanggal"
                    value="<?= $data['tanggal'] ?>"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">

                </div>

                <!-- STATUS -->
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Status Kehadiran
                    </label>

                    <select
                    name="status_hadir"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500">

                        <option
                        value="Hadir"

                        <?php
                        if($data['status_hadir']
                        == 'Hadir') {
                            echo "selected";
                        }
                        ?>>

                            Hadir

                        </option>

                        <option
                        value="Tidak Hadir"

                        <?php
                        if($data['status_hadir']
                        == 'Tidak Hadir') {
                            echo "selected";
                        }
                        ?>>

                            Tidak Hadir

                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="flex items-center gap-3 pt-2">

                    <button
                    class="bg-emerald-600 hover:bg-emerald-700 transition-all text-white text-sm font-semibold px-6 py-3 rounded-xl">

                        Update Data

                    </button>

                    <a
                    href="index.php"
                    class="text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-all">

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </main>

</body>
</html>