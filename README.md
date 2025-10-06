<p align="center">
  <img src="assets/img/logo_sinjai.png" alt="Logo Juri Digital" width="150">
</p>

<h1 align="center">Juri Digital - Aplikasi Penjurian Serbaguna</h1>

<p align="center">
  "Juri Digital" adalah platform penjurian berbasis web yang dirancang sebagai solusi universal untuk mengelola berbagai jenis kompetisi secara efisien, akurat, dan transparan.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter">
  <img src="https://img.shields.io/badge/AdminLTE-007BFF?style=for-the-badge&logo=bootstrap&logoColor=white" alt="AdminLTE">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

---

## ✨ Fitur Utama

- **Manajemen Kompetisi**: Membuat dan mengelola beberapa kompetisi secara terpusat.
- **Templat Penilaian Dinamis**: Membuat, menyimpan, dan menggunakan ulang set kriteria penilaian yang modular untuk berbagai jenis lomba.
- **Penjurian Fleksibel**: Menugaskan juri untuk menilai karya atau bahkan indikator kriteria tertentu sesuai keahliannya.
- **Dukungan Multi-Karya**: Menerima pendaftaran karya dengan format beragam (URL, unggah file, dll) berkat struktur data JSON yang fleksibel.
- **Rekapitulasi Nilai Otomatis**: Sistem menghitung skor akhir secara *real-time* berdasarkan bobot kriteria yang telah ditentukan, mengurangi risiko kesalahan manual.
- **Manajemen Pengguna (RBAC)**: Sistem hak akses berbasis peran (*Role-Based Access Control*) untuk Administrator, Juri, dan peran lainnya.

## 💻 Spesifikasi Teknis

- **Backend Framework**: PHP CodeIgniter 3
- **Frontend Template**: AdminLTE 3
- **Database**: MySQL / MariaDB

## 🚀 Instalasi

1.  **Clone repositori ini:**
    ```bash
    git clone git@github.com:cedirusyaid/juri_digital.git
    cd juri_digital
    ```

2.  **Install dependencies (jika menggunakan Composer):**
    ```bash
    composer install
    ```

3.  **Konfigurasi Database:**
    - Salin file `application/config/database.php.example` menjadi `application/config/database.php`.
      ```bash
      cp application/config/database.php.example application/config/database.php
      ```
    - Buka file `application/config/database.php` dan isi detail koneksi database Anda (username, password, nama database).

4.  **Import Database:**
    - Import file `juri_digital_serbaguna_db.sql` ke dalam database MySQL/MariaDB Anda.

5.  **Selesai!**
    - Arahkan web server Anda ke direktori `juri_digital` dan buka aplikasi di browser.

## 🔑 Akun Default

Setelah instalasi selesai, Anda dapat login menggunakan akun Super Admin default:

- **Email**: `admin@example.com`
- **Password**: `admin`

## 📸 Screenshot

_(Anda dapat menambahkan screenshot aplikasi di sini untuk membuatnya lebih menarik)_ 

<!-- Contoh:
![Halaman Login](link/ke/screenshot_login.png)
![Halaman Dashboard](link/ke/screenshot_dashboard.png)
-->