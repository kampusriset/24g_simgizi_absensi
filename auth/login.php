<?php
session_start();
require '../config/database.php';
require '../models/User.php';

$db = (new Database())->connect();
$userModel = new User($db);

if ($_POST) {
    $user = $userModel->login($_POST['username']);
    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Gizi Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-illustration {
            background-image: url('https://images.unsplash.com/photo-1490818387583-1baba5e638af?q=80&w=1932&auto=format&fit=crop'); /* Gambar makanan sehat/fresh */
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center p-4 md:p-0">

    <div class="flex w-full max-w-[1200px] h-full md:h-[700px] bg-white overflow-hidden md:rounded-[40px] md:shadow-2xl">
        
        <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center">
            <div class="flex items-center gap-2 mb-12">
                <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="font-extrabold text-slate-800 tracking-tighter">SIM-GIZI</span>
            </div>

            <div class="mb-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                    Pantau Gizi,<br> 
                    <span class="text-emerald-600">Mulai Hari Ini.</span>
                </h1>
                <p class="text-slate-400 mt-4 font-medium">Akses sistem absensi penerima manfaat Badan Gizi Nasional.</p>
            </div>

            <?php if(isset($error)): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-semibold border border-red-100 italic">
                    ⚠ <?= $error ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-5">
                <input type="text" name="username" placeholder="Username" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 focus:outline-none focus:border-emerald-500 transition-all">
                
                <input type="password" name="password" placeholder="Password" required
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-6 py-4 focus:outline-none focus:border-emerald-500 transition-all">

                <div class="flex items-center justify-between text-sm py-2">
                    <label class="flex items-center gap-2 text-slate-400 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"> Remember me
                    </label>
                    <a href="#" class="text-slate-400 hover:text-emerald-600 font-medium">Forgot Password?</a>
                </div>

                <button type="submit" 
                    class="w-full md:w-32 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl ]">
                    Sign In
                </button>
            </form>

            <p class="mt-12 text-sm text-slate-400 font-medium">
                Don't have an account? <a href="register.php" class="text-orange-500 font-bold hover:underline">Register</a>
            </p>
        </div>

        <div class="hidden md:block md:w-1/2 p-6">
            <div class="w-full h-full bg-illustration rounded-[32px] relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/40 to-transparent"></div>
                
                <div class="absolute bottom-12 left-12 right-12 text-white">
                    <p class="text-2xl font-bold italic">"Kesehatan tidak ternilai harganya, mulailah mencatat setiap langkahmu."</p>
                    <div class="mt-4 flex gap-2">
                        <div class="w-8 h-1 bg-white rounded-full"></div>
                        <div class="w-2 h-1 bg-white/40 rounded-full"></div>
                        <div class="w-2 h-1 bg-white/40 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>