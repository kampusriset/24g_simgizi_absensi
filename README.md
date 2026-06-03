# 24g_simgizi_absensi

## 📖 Deskripsi Aplikasi
Aplikasi Sistem Informasi Manajemen (SIM) ini dikembangkan sebagai proyek Ujian Tengah Semester (UTS) genap T.A. 2025/2026 untuk mata kuliah Pemrograman Web. Aplikasi ini merupakan pengembangan lanjutan dari base project "SIM Playlist" dengan mengimplementasikan fitur CRUD (Create, Read, Update, Delete) secara utuh. Tampilan antarmuka aplikasi ini telah dikustomisasi menggunakan framework Tailwind CSS.

## ✨ Fitur Aplikasi
Sistem ini dilengkapi dengan fungsionalitas berikut:
* **Register & Login:** Sistem autentikasi untuk membatasi akses pengguna.
* **Dashboard:** Halaman ringkasan utama setelah pengguna berhasil masuk.
* **Manajemen Data (CRUD):**
  * **Create:** Fitur untuk menambahkan data absensi baru.
  * **Read:** Menampilkan daftar data absensi secara terstruktur.
  * **Update:** Fitur untuk memperbarui atau mengedit data yang sudah ada.
  * **Delete:** Fitur untuk menghapus data dari sistem.
* **Logout:** Mengakhiri sesi pengguna dengan aman.

## 🚀 Cara Menjalankan Aplikasi
Berikut adalah langkah-langkah untuk menjalankan aplikasi di lingkungan lokal:
1. Pastikan Anda memiliki web server lokal seperti XAMPP, MAMP, atau Laragon yang sudah terinstal.
2. Buka terminal/Command Prompt dan lakukan *clone* repository ini ke direktori server lokal Anda (contoh: folder `htdocs` jika menggunakan XAMPP).
```bash
git clone [https://github.com/kampusriset/24g_simgizi_absensi]
```
3. Buat database baru di phpMyAdmin dengan nama (misal) sim_gizi.
4. Import file .sql yang terdapat di repository ini ke dalam database yang baru dibuat.
5. Buka file konfigurasi koneksi database (misal: database.php) dan sesuaikan username, password, serta nama database dengan server lokal Anda.
6. Buka web browser dan akses aplikasi melalui URL: http://localhost/24g_simgizi_absensi

## 🗄️ Struktur Database
Database sim_gizi meliputi beberapa Table:
1. Table absensi:
   a. id_absensi (Primary Key)
   b. id_penerima
   c. tanggal
   d. status_hadir
2. Table penerima_manfaat:
   a. id_penerima (Primary Key)
   b. nama
   c. nik
   d. alamat
   e. status
3. Table users:
   a. id_user (Primary Key)
   b. nama
   c. username
   d. password
   e. role
   f. created_at
