# 24g_simgizi_absensi

## 📖 Deskripsi Aplikasi
Aplikasi Sistem Informasi Manajemen (SIM) ini dikembangkan sebagai proyek Ujian Tengah Semester (UTS) genap T.A. 2025/2026 untuk mata kuliah Pemrograman Web. Aplikasi ini merupakan pengembangan lanjutan dari base project "SIM Playlist" dengan mengimplementasikan fitur CRUD (Create, Read, Update, Delete) secara utuh. Tampilan antarmuka aplikasi ini telah dikustomisasi menggunakan framework Tailwind CSS.

## ✨ Fitur Aplikasi
Sistem ini dilengkapi dengan fungsionalitas berikut:
* **Register & Login:** Sistem autentikasi untuk membatasi akses pengguna.
* **Dashboard:** Halaman ringkasan utama setelah pengguna berhasil masuk.
* **Manajemen Data (CRUD):**
  * **Create:** Fitur untuk menambahkan data [Sebutkan jenis datanya] baru.
  * **Read:** Menampilkan daftar data [Sebutkan jenis datanya] secara terstruktur.
  * **Update:** Fitur untuk memperbarui atau mengedit data yang sudah ada.
  * **Delete:** Fitur untuk menghapus data dari sistem.
* **Logout:** Mengakhiri sesi pengguna dengan aman.

## 🚀 Cara Menjalankan Aplikasi
Berikut adalah langkah-langkah untuk menjalankan aplikasi di lingkungan lokal:
1. Pastikan Anda memiliki web server lokal seperti XAMPP, MAMP, atau Laragon yang sudah terinstal.
2. Buka terminal/Command Prompt dan lakukan *clone* repository ini ke direktori server lokal Anda (contoh: folder `htdocs` jika menggunakan XAMPP).
   ```bash
git clone [MASUKKAN_URL_REPOSITORY_ANDA]
Buat database baru di phpMyAdmin dengan nama (misal) db_sim_kelompok.

Import file .sql yang terdapat di repository ini ke dalam database yang baru dibuat.

Buka file konfigurasi koneksi database (misal: koneksi.php) dan sesuaikan username, password, serta nama database dengan server lokal Anda.

Buka web browser dan akses aplikasi melalui URL: http://localhost/[nama-folder-repositori-anda]
