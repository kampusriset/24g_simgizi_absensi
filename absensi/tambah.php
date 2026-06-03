<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

require '../config/database.php';
require '../models/Absensi.php';

$db = (new Database())->connect();
$absensiModel = new Absensi($db);

// AMBIL DATA PENERIMA
$penerima = $absensiModel->getPenerima();

// SIMPAN DATA
if ($_POST) {
    $absensiModel->create(
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi - SIM Gizi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 text-slate-700">

    <div class="w-full max-w-xl">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-10 h-10 bg-[#059669] rounded-xl text-white text-xs font-bold italic mb-4 shadow-lg shadow-emerald-100">G</div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Tambah Data Absensi</h2>
            <p class="text-slate-400 text-[13px] mt-1">Silakan lengkapi detail kehadiran di bawah ini.</p>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] border border-gray-100 shadow-sm">
            <form method="POST" class="space-y-6">
                
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-2 ml-1">Penerima Gizi</label>
                    <select name="id_penerima" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-[13px] focus:outline-none focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                        <option value="">-- Pilih Nama Penerima --</option>
                        <?php while($row = $penerima->fetch_assoc()): ?>
                            <option value="<?= $row['id_penerima'] ?>"><?= $row['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-2 ml-1">Tanggal Kegiatan</label>
                    <input type="date" name="tanggal" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-[13px] focus:outline-none focus:border-emerald-500 transition-all">
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.1em] mb-2 ml-1">Status Absensi</label>
                    <select name="status_hadir" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-5 py-4 text-[13px] focus:outline-none focus:border-emerald-500 transition-all appearance-none cursor-pointer">
                        <option value="Hadir">Hadir</option>
                        <option value="Tidak Hadir">Tidak Hadir</option>
                    </select>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" 
                        class="flex-[2] bg-[#059669] hover:bg-[#047857] text-white font-bold py-4 rounded-2xl text-[13px] transition-all active:scale-[0.98]">
                        Simpan Data
                    </button>
                    <a href="index.php" 
                        class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 text-center font-bold py-4 rounded-2xl text-[13px] transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-10 text-center">
            <a href="index.php" class="text-[12px] font-bold text-slate-400 hover:text-emerald-600 transition-all inline-flex items-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                Kembali ke Daftar Absensi
            </a>
        </div>
    </div>

</body>
</html>