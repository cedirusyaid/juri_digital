<div class="container-fluid">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h3><?php echo isset($title) ? $title : 'Selamat Datang di Juri Digital'; ?></h3>
            </div>
            <div class="card-body">
                <p><strong>"Juri Digital"</strong> adalah platform penjurian berbasis web yang dirancang sebagai solusi universal untuk mengelola berbagai jenis kompetisi secara efisien, akurat, dan transparan. Aplikasi ini berevolusi dari platform khusus website menjadi sebuah sistem fleksibel yang dapat mengakomodasi lomba desain grafis, aplikasi mobile, business plan, karya tulis, dan kompetisi lainnya.</p>

                <h4>1. Konsep dan Tujuan 🎯</h4>
                <ul>
                    <li>**Tujuan Utama**: Menyediakan satu platform terpusat untuk mengelola seluruh siklus hidup kompetisi, mulai dari pembuatan kriteria penilaian yang modular, manajemen peserta dengan beragam jenis karya, hingga proses penjurian dan rekapitulasi nilai otomatis.</li>
                    <li>**Konsep**: Sebuah ekosistem digital di mana **Administrator** memiliki kendali penuh untuk "merakit" sebuah kompetisi sesuai kebutuhannya, dan **Juri** mendapatkan pengalaman menilai yang terstruktur dan relevan dengan bidang keahliannya.</li>
                    <li>**Keunggulan**: Serbaguna, Modular, Spesialisasi Juri, Otomatisasi dan Akurasi.</li>
                </ul>

                <h4>2. Pengguna dan Hak Akses (Sistem RBAC)</h4>
                <p>Aplikasi ini didukung oleh sistem *Role-Based Access Control* (RBAC) yang matang, memanfaatkan tabel `users`, `roles`, dan `izin_akses`.</p>
                <ul>
                    <li>**Users**: Setiap individu yang dapat login ke dalam sistem.</li>
                    <li>**Peran (Roles)**: Label fungsional yang mendefinisikan tanggung jawab umum seorang pengguna, seperti 'Administrator' atau 'Juri'.</li>
                    <li>**Izin Akses**: Hak spesifik untuk melakukan sebuah aksi.</li>
                </ul>

                <h4>3. Alur Kerja Aplikasi 📝</h4>
                <p>Alur kerja aplikasi dirancang untuk menjadi logis dan adaptif terhadap berbagai skenario kompetisi, meliputi Tahap Persiapan (Administrator), Tahap Penilaian (Juri), dan Tahap Rekapitulasi (Administrator).</p>

                <h4>4. Spesifikasi Teknis 💻</h4>
                <ul>
                    <li>**Backend Framework**: PHP CodeIgniter 4 (Catatan: Saat ini menggunakan CodeIgniter 3, namun deskripsi menyebutkan CI4).</li>
                    <li>**Frontend Template**: CoreUI (sebelumnya SB Admin).</li>
                    <li>**Database**: MySQL atau MariaDB.</li>
                </ul>

                <h4>5. Fitur Utama Aplikasi ✨</h4>
                <ul>
                    <li>Pustaka Templat Penilaian</li>
                    <li>Dukungan Multi-Karya</li>
                    <li>Penjurian oleh Panel Ahli</li>
                    <li>Manajemen Kompetisi Terpusat</li>
                    <li>Laporan dan Analitik Dinamis</li>
                </ul>
            </div>
        </div>
    </div>
</div>