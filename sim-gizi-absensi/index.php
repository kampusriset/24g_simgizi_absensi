<?php
// Memastikan tidak ada output sebelum header
session_start();

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit;
}

// Jika belum login, lempar ke login
header("Location: auth/login.php");
exit;
?>