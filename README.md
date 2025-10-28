# 📋 **DOKUMEN RENCANA PENGEMBANGAN APLIKASI SI TERNAK**
## *(Sistem Recording Ternak)*

---

## 🎯 **OVERVIEW PROYEK**

### **Informasi Umum**
- **Nama Aplikasi**: SI TERNAK (Sistem Recording Ternak)
- **Framework**: CodeIgniter 3
- **Admin Template**: Admin LTE 2/3
- **Database**: MySQL
- **Target Pengguna**: Dinas Peternakan Kabupaten Sinjai

### **Tujuan Pengembangan**
1. Digitalisasi recording data peternakan
2. Integrasi 3 sistem utama (Perkembangan, IB, Produksi Pakan)
3. Otomatisasi laporan bulanan
4. Monitoring real-time perkembangan ternak

---

## 🏗️ **STRUKTUR APLIKASI**

```
si_ternak/
├── application/
│   ├── config/
│   ├── controllers/
│   │   ├── Auth.php
│   │   ├── Dashboard.php
│   │   ├── Perkembangan.php
│   │   ├── Inseminasi.php
│   │   ├── Pakan.php
│   │   └── Laporan.php
│   ├── models/
│   │   ├── M_perkembangan.php
│   │   ├── M_inseminasi.php
│   │   ├── M_pakan.php
│   │   └── M_user.php
│   ├── views/
│   │   ├── templates/
│   │   ├── dashboard/
│   │   ├── perkembangan/
│   │   ├── inseminasi/
│   │   ├── pakan/
│   │   └── laporan/
│   └── libraries/
├── assets/
│   ├── css/
│   ├── js/
│   ├── img/
│   └── uploads/
└── system/
```

---

## 🗃️ **DESAIN DATABASE MYSQL**

### **Script Database Lengkap**

```sql
-- =============================================
-- DATABASE: si_ternak_sinjai
-- =============================================

CREATE DATABASE si_ternak_sinjai;
USE si_ternak_sinjai;

-- =============================================
-- TABLE USERS (AUTHENTICATION)
-- =============================================

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    nip VARCHAR(50),
    jabatan VARCHAR(100),
    role ENUM('admin', 'operator', 'penandatangan', 'petugas') DEFAULT 'operator',
    is_active TINYINT(1) DEFAULT 1,
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- SISTEM 1: PERKEMBANGAN TERNAK BANTUAN
-- =============================================

CREATE TABLE kelompok_ternak (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kode_kelompok VARCHAR(20) UNIQUE NOT NULL,
    nama_kelompok VARCHAR(255) NOT NULL,
    desa VARCHAR(100),
    kecamatan VARCHAR(100),
    alamat_lengkap TEXT,
    tahun_anggaran YEAR,
    sumber_dana ENUM('APBN', 'APBD I', 'APBD II'),
    ras_ternak ENUM('Bali', 'Kambing', 'Sapi Perah'),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE laporan_bulanan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    kelompok_id INT,
    bulan TINYINT CHECK (bulan BETWEEN 1 AND 12),
    tahun YEAR,
    
    -- Data Awal Bulan
    ternak_awal_jt INT DEFAULT 0,
    ternak_awal_bt INT DEFAULT 0,
    populasi_awal_dewasa_jt INT DEFAULT 0,
    populasi_awal_dewasa_bt INT DEFAULT 0,
    populasi_awal_anak_jt INT DEFAULT 0,
    populasi_awal_anak_bt INT DEFAULT 0,
    
    -- Perkembangan
    lahir_jt INT DEFAULT 0,
    lahir_bt INT DEFAULT 0,
    mati_dewasa_jt INT DEFAULT 0,
    mati_dewasa_bt INT DEFAULT 0,
    mati_anak_jt INT DEFAULT 0,
    mati_anak_bt INT DEFAULT 0,
    setor_jt INT DEFAULT 0,
    setor_bt INT DEFAULT 0,
    jual_jt INT DEFAULT 0,
    jual_bt INT DEFAULT 0,
    hilang_jt INT DEFAULT 0,
    hilang_bt INT DEFAULT 0,
    
    -- Data Akhir Bulan
    populasi_akhir_dewasa_jt INT DEFAULT 0,
    populasi_akhir_dewasa_bt INT DEFAULT 0,
    populasi_akhir_anak_jt INT DEFAULT 0,
    populasi_akhir_anak_bt INT DEFAULT 0,
    
    -- Kumulatif
    jumlah_kumulatif_jt INT DEFAULT 0,
    jumlah_kumulatif_bt INT DEFAULT 0,
    jumlah_total INT DEFAULT 0,
    
    keterangan TEXT,
    status ENUM('draft', 'submitted', 'verified') DEFAULT 'draft',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (kelompok_id) REFERENCES kelompok_ternak(id),
    FOREIGN KEY (created_by) REFERENCES users(id),
    UNIQUE KEY unique_laporan (kelompok_id, bulan, tahun)
);

-- =============================================
-- SISTEM 2: INSEMINASI BUATAN & KELAHIRAN
-- =============================================

CREATE TABLE petugas_lapangan (
    id_petugas VARCHAR(20) PRIMARY KEY,
    nama_petugas VARCHAR(100) NOT NULL,
    nip VARCHAR(30),
    pangkat VARCHAR(50),
    jabatan VARCHAR(100),
    no_hp VARCHAR(15),
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE peternak (
    id_peternak VARCHAR(20) PRIMARY KEY,
    nama_peternak VARCHAR(100) NOT NULL,
    alamat TEXT,
    desa VARCHAR(100),
    kecamatan VARCHAR(100),
    no_hp VARCHAR(15),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE hewan (
    id_hewan VARCHAR(20) PRIMARY KEY,
    id_peternak VARCHAR(20),
    nama_hewan VARCHAR(100),
    bangsa_induk VARCHAR(50),
    jenis_kelamin ENUM('jantan', 'betina'),
    tanggal_lahir DATE,
    status ENUM('aktif', 'mati', 'terjual') DEFAULT 'aktif',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_peternak) REFERENCES peternak(id_peternak)
);

CREATE TABLE inseminasi (
    id_ib VARCHAR(20) PRIMARY KEY,
    id_hewan VARCHAR(20),
    id_petugas VARCHAR(20),
    tanggal_ib DATE NOT NULL,
    kecamatan VARCHAR(50),
    desa VARCHAR(50),
    ib_ke INT,
    id_pejantan VARCHAR(20),
    id_pembuatan VARCHAR(20),
    bangsa_pejantan VARCHAR(50),
    produsen VARCHAR(100),
    periode_laporan VARCHAR(50),
    status ENUM('berhasil', 'gagal', 'menunggu') DEFAULT 'menunggu',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_hewan) REFERENCES hewan(id_hewan),
    FOREIGN KEY (id_petugas) REFERENCES petugas_lapangan(id_petugas),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE kelahiran (
    id_laporan INT PRIMARY KEY AUTO_INCREMENT,
    tgl_laporan DATE NOT NULL,
    tgl_kelahiran DATE NOT NULL,
    id_hewan VARCHAR(20),
    id_petugas VARCHAR(20),
    kecamatan VARCHAR(50),
    desa VARCHAR(50),
    jenis_kelamin ENUM('jantan', 'betina'),
    metode_kawin ENUM('IB', 'Kawin Alam'),
    kode_straw VARCHAR(50),
    id_pembuatan VARCHAR(20),
    bangsa_pejantan VARCHAR(50),
    produsen_pejantan VARCHAR(100),
    status_kelahiran ENUM('hidup', 'mati') DEFAULT 'hidup',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_hewan) REFERENCES hewan(id_hewan),
    FOREIGN KEY (id_petugas) REFERENCES petugas_lapangan(id_petugas),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE pemeriksaan_kebuntingan (
    id_pkb INT PRIMARY KEY AUTO_INCREMENT,
    id_hewan VARCHAR(20),
    id_petugas VARCHAR(20),
    tanggal_ib DATE,
    tanggal_pkb DATE NOT NULL,
    kecamatan VARCHAR(50),
    desa VARCHAR(50),
    hasil_kebuntingan ENUM('Bunting', 'Tidak Bunting'),
    metode ENUM('IB', 'Kawin Alam'),
    umur_kebuntingan INT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_hewan) REFERENCES hewan(id_hewan),
    FOREIGN KEY (id_petugas) REFERENCES petugas_lapangan(id_petugas),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- =============================================
-- SISTEM 3: PRODUKSI PAKAN TERNAK
-- =============================================

CREATE TABLE kelompok_produksi_pakan (
    id_kelompok VARCHAR(20) PRIMARY KEY,
    nama_kelompok VARCHAR(255) NOT NULL,
    kecamatan VARCHAR(100),
    desa VARCHAR(100),
    alamat_lengkap TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE jenis_pakan (
    id_jenis_pakan VARCHAR(10) PRIMARY KEY,
    nama_jenis VARCHAR(100) NOT NULL,
    kategori ENUM('Silase', 'Konsentrat', 'Limbah'),
    satuan VARCHAR(20) DEFAULT 'KG',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE laporan_produksi_pakan (
    id_laporan INT PRIMARY KEY AUTO_INCREMENT,
    id_kelompok VARCHAR(20),
    bulan TINYINT CHECK (bulan BETWEEN 1 AND 12),
    tahun YEAR,
    periode_laporan VARCHAR(50),
    status ENUM('draft', 'submitted', 'verified') DEFAULT 'draft',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelompok) REFERENCES kelompok_produksi_pakan(id_kelompok),
    FOREIGN KEY (created_by) REFERENCES users(id),
    UNIQUE KEY unique_produksi (id_kelompok, bulan, tahun)
);

CREATE TABLE detail_produksi_pakan (
    id_detail INT PRIMARY KEY AUTO_INCREMENT,
    id_laporan INT,
    id_jenis_pakan VARCHAR(10),
    jumlah_produksi INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_laporan) REFERENCES laporan_produksi_pakan(id_laporan),
    FOREIGN KEY (id_jenis_pakan) REFERENCES jenis_pakan(id_jenis_pakan)
);

CREATE TABLE rekap_total_produksi (
    id_rekap INT PRIMARY KEY AUTO_INCREMENT,
    id_kelompok VARCHAR(20),
    bulan TINYINT,
    tahun YEAR,
    total_produksi_bulanan INT DEFAULT 0,
    total_kumulatif INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kelompok) REFERENCES kelompok_produksi_pakan(id_kelompok)
);

-- =============================================
-- TABLE SETTING & CONFIGURATION
-- =============================================

CREATE TABLE app_settings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    setting_group VARCHAR(50),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE laporan_verifikasi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    laporan_id INT,
    laporan_type ENUM('perkembangan', 'produksi_pakan'),
    verifikator_id INT,
    catatan TEXT,
    status ENUM('diterima', 'ditolak', 'revisi'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (verifikator_id) REFERENCES users(id)
);

-- =============================================
-- INSERT DATA MASTER
-- =============================================

-- Insert default admin user
INSERT INTO users (username, password, nama_lengkap, email, nip, jabatan, role) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@sinjai.go.id', '-', 'Administrator Sistem', 'admin');

-- Insert jenis pakan
INSERT INTO jenis_pakan (id_jenis_pakan, nama_jenis, kategori) VALUES
('SL01', 'Jerami', 'Silase'),
('SL02', 'Rumput Gajah', 'Silase'),
('SL03', 'Batang Jagung', 'Silase'),
('SL04', 'Kulit Jagung', 'Silase'),
('SL05', 'Limbah Batang Pisang', 'Silase'),
('KN01', 'Konsentrat', 'Konsentrat');

-- Insert petugas contoh
INSERT INTO petugas_lapangan (id_petugas, nama_petugas, nip, jabatan) VALUES
('PTG001', 'A. YUDA DARMAN, S.Pt', '19860114 201001 1 018', 'Petugas IB'),
('PTG002', 'ANSAR', NULL, 'Petugas Pelapor Kelahiran'),
('PTG003', 'SAIFUDDIN', NULL, 'Pemeriksa Kebuntingan');

-- Insert app settings
INSERT INTO app_settings (setting_key, setting_value, setting_group, description) VALUES
('app_name', 'SI TERNAK - Kabupaten Sinjai', 'general', 'Nama Aplikasi'),
('instansi', 'Dinas Peternakan dan Kesehatan Hewan Kabupaten Sinjai', 'general', 'Nama Instansi'),
('tahun_anggaran', '2025', 'general', 'Tahun Anggaran Berjalan');
```

---

## 🔍 **QUERY UTAMA UNTUK APLIKASI**

### **1. Query Dashboard**

```sql
-- Dashboard Statistik
SELECT 
    (SELECT COUNT(*) FROM kelompok_ternak) as total_kelompok,
    (SELECT COUNT(*) FROM laporan_bulanan WHERE bulan = MONTH(CURDATE()) AND tahun = YEAR(CURDATE())) as laporan_bulan_ini,
    (SELECT COUNT(*) FROM inseminasi WHERE MONTH(tanggal_ib) = MONTH(CURDATE())) as ib_bulan_ini,
    (SELECT COUNT(*) FROM laporan_produksi_pakan WHERE bulan = MONTH(CURDATE()) AND tahun = YEAR(CURDATE())) as produksi_bulan_ini;
```

### **2. Query Laporan Perkembangan**

```sql
-- Laporan Perkembangan Bulanan
SELECT 
    k.nama_kelompok,
    k.kecamatan,
    k.desa,
    l.bulan,
    l.tahun,
    l.populasi_awal_dewasa_jt + l.populasi_awal_dewasa_bt as awal_dewasa,
    l.populasi_akhir_dewasa_jt + l.populasi_akhir_dewasa_bt as akhir_dewasa,
    l.lahir_jt + l.lahir_bt as total_lahir,
    l.jumlah_total
FROM laporan_bulanan l
JOIN kelompok_ternak k ON l.kelompok_id = k.id
WHERE l.bulan = 1 AND l.tahun = 2025
ORDER BY k.kecamatan, k.nama_kelompok;
```

### **3. Query Produksi Pakan**

```sql
-- Laporan Produksi Pakan Bulanan
SELECT 
    k.nama_kelompok,
    k.kecamatan,
    l.bulan,
    l.tahun,
    SUM(CASE WHEN j.id_jenis_pakan = 'SL01' THEN d.jumlah_produksi ELSE 0 END) as jerami,
    SUM(CASE WHEN j.id_jenis_pakan = 'SL02' THEN d.jumlah_produksi ELSE 0 END) as rumput_gajah,
    SUM(CASE WHEN j.id_jenis_pakan = 'KN01' THEN d.jumlah_produksi ELSE 0 END) as konsentrat,
    SUM(d.jumlah_produksi) as total_produksi
FROM laporan_produksi_pakan l
JOIN kelompok_produksi_pakan k ON l.id_kelompok = k.id_kelompok
JOIN detail_produksi_pakan d ON l.id_laporan = d.id_laporan
JOIN jenis_pakan j ON d.id_jenis_pakan = j.id_jenis_pakan
WHERE l.bulan = 1 AND l.tahun = 2025
GROUP BY k.nama_kelompok, k.kecamatan, l.bulan, l.tahun
ORDER BY k.kecamatan, k.nama_kelompok;
```

### **4. Query IB & Kelahiran**

```sql
-- Data IB dan Kelahiran
SELECT 
    i.tanggal_ib,
    h.id_hewan,
    p.nama_peternak,
    pt.nama_petugas,
    i.bangsa_pejantan,
    i.status,
    (SELECT COUNT(*) FROM kelahiran k WHERE k.id_hewan = h.id_hewan) as total_kelahiran
FROM inseminasi i
JOIN hewan h ON i.id_hewan = h.id_hewan
JOIN peternak p ON h.id_peternak = p.id_peternak
JOIN petugas_lapangan pt ON i.id_petugas = pt.id_petugas
WHERE MONTH(i.tanggal_ib) = MONTH(CURDATE())
ORDER BY i.tanggal_ib DESC;
```

---

## 🚀 **RENCANA PENGEMBANGAN**

### **Fase 1: Setup & Authentication (Minggu 1-2)**
- [ ] Install CodeIgniter 3 + Admin LTE
- [ ] Setup database dan struktur tabel
- [ ] Buat sistem authentication
- [ ] Dashboard utama

### **Fase 2: Sistem Perkembangan Ternak (Minggu 3-4)**
- [ ] CRUD Kelompok Ternak
- [ ] Input Laporan Bulanan
- [ ] Laporan dan monitoring

### **Fase 3: Sistem Produksi Pakan (Minggu 5-6)**
- [ ] Master data pakan
- [ ] Input produksi bulanan
- [ ] Laporan produksi

### **Fase 4: Sistem IB & Kelahiran (Minggu 7-8)**
- [ ] Data petugas & peternak
- [ ] Input IB dan kelahiran
- [ ] Monitoring reproduksi

### **Fase 5: Reporting & Export (Minggu 9-10)**
- [ ] Generate laporan Excel
- [ ] Export PDF
- [ ] Chart dan statistik

### **Fase 6: Testing & Deployment (Minggu 11-12)**
- [ ] Uji coba sistem
- [ ] Training pengguna
- [ ] Deployment production

---

## 🎨 **DESAIN VIEW (Admin LTE)**

### **Struktur Layout**
```php
<!-- application/views/templates/header.php -->
<!DOCTYPE html>
<html>
<head>
    <title>SI TERNAK - <?php echo $title; ?></title>
    <!-- Admin LTE CSS & JS -->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
```

### **Menu Sidebar**
```php
<!-- application/views/templates/sidebar.php -->
<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active"><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-line-chart"></i> <span>Perkembangan Ternak</span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('perkembangan/kelompok'); ?>">Data Kelompok</a></li>
                    <li><a href="<?php echo site_url('perkembangan/laporan'); ?>">Laporan Bulanan</a></li>
                </ul>
            </li>
            <!-- Menu lainnya -->
        </ul>
    </section>
</aside>
```

---

## 🔐 **KEAMANAN**

### **Authentication System**
```php
// application/controllers/Auth.php
class Auth extends CI_Controller {
    public function login() {
        // Login process
    }
    
    public function logout() {
        // Logout process
    }
}
```

### **Access Control**
```php
// application/libraries/MY_Controller.php
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }
}
```

---

## 📱 **FITUR UTAMA**

### **1. Dashboard Real-time**
- Statistik perkembangan ternak
- Grafik produksi pakan
- Notifikasi laporan tertunda

### **2. Multi-user System**
- Admin: Full access
- Operator: Input data
- Penandatangan: Verifikasi laporan
- Petugas: Input data lapangan

### **3. Reporting System**
- Laporan bulanan otomatis
- Export Excel & PDF
- Chart dan grafik

### **4. Mobile Friendly**
- Responsive design
- Akses dari smartphone
- Form input yang sederhana

---

## ✅ **DELIVERABLES**

1. **Source Code** aplikasi lengkap
2. **Database** MySQL
3. **Dokumentasi** penggunaan
4. **User Manual** untuk masing-masing role
5. **Training** untuk admin dan operator

**Timeline**: 12 minggu
**Budget**: Rp 45.000.000 - Rp 60.000.000
**Technology Stack**: CodeIgniter 3, MySQL, Admin LTE, Bootstrap, jQuery

---
**SI TERNAK - Sistem Recording Ternak Terintegrasi Kabupaten Sinjai** 🐄🚀