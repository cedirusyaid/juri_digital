# Juri Digital - Aplikasi Penjurian Serbaguna

"Juri Digital" adalah platform penjurian berbasis web yang dirancang sebagai solusi universal untuk mengelola berbagai jenis kompetisi secara efisien, akurat, dan transparan.

## Spesifikasi Teknis
- **Backend Framework**: PHP CodeIgniter 3
- **Frontend Template**: AdminLTE
- **Database**: MySQL / MariaDB

## Instalasi

1.  **Clone repositori ini:**
    ```bash
    git clone [URL_REPOSITORY_ANDA]
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
