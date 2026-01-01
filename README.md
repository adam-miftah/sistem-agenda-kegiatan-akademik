# 📅 SI-AGENDA - Sistem Informasi Agenda Kegiatan Akademik

Selamat datang di **SI-AGENDA**! Solusi digital modern untuk mempermudah penjadwalan, pengelolaan, dan pelaporan kegiatan akademik di lingkungan **Universitas Pamulang**. Proyek ini hadir untuk menggantikan pencatatan agenda manual menjadi sistem terpusat yang rapi, transparan, dan mudah diakses.

[![Versi Proyek](https://img.shields.io/badge/version-1.0.0-blue?style=for-the-badge)](https://github.com/adammiftah/si-agenda)
[![Framework Digunakan](https://img.shields.io/badge/Framework-Laravel_10-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.2-777BB4?style=for-the-badge&logo=php)](https://www.php.net/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

---

## ✨ Mengapa SI-AGENDA?

Manajemen waktu yang buruk seringkali menjadi penghambat produktivitas akademik. Aplikasi kami hadir menawarkan solusi:
* 🚀 **Manajemen Terpusat:** Semua jadwal kegiatan (kuliah, seminar, rapat) tersimpan dalam satu database yang aman.
* 🔍 **Pencarian Cepat (Live Search):** Temukan agenda spesifik dalam hitungan detik tanpa reload halaman.
* 📊 **Dashboard Informatif:** Pantau statistik kegiatan (Pending, Selesai, Dibatalkan) melalui visualisasi yang jelas.
* 📑 **Laporan Otomatis:** Cetak laporan kegiatan berdasarkan periode dan kategori ke dalam format PDF resmi dengan sekali klik.
* 📱 **Akses Personal:** Mahasiswa memiliki dashboard pribadi untuk mengatur jadwal mereka sendiri.

---

## 🎯 Fitur Unggulan

* 👤 **Multi-Role User** (Administrator & Mahasiswa)
* ⚡ **AJAX Live Search & Pagination** (Pencarian data super cepat tanpa refresh halaman)
* 📊 **Dashboard Statistik** (Ringkasan total agenda, status kegiatan, dan user terdaftar)
* 📝 **Manajemen Kegiatan** (CRUD Agenda dengan status: Pending, Selesai, Batal)
* 📂 **Kategori Dinamis** (Pengelompokan agenda agar lebih terorganisir)
* 📄 **Ekspor Laporan PDF** (Filter berdasarkan Tanggal, Kategori, Status dengan Kop Surat Resmi)
* 🖼️ **Manajemen Profil** (Update Biodata, Ganti Password, & Upload Foto Profil)
* 🔐 **Keamanan Terjamin** (Autentikasi aman, Validasi Input, & CSRF Protection)
* 🎨 **UI/UX Modern** (Desain responsif berbasis Bootstrap 5 & SweetAlert2)

---

## 🛠️ Stack Teknologi

Aplikasi ini dibangun dengan teknologi yang handal dan modern:

* **Backend:** PHP (Framework Laravel 10)
* **Frontend:** Blade Templating, Bootstrap 5, FontAwesome, SweetAlert2
* **Database:** MySQL
* **Libraries:**
    * `barryvdh/laravel-dompdf` (Cetak PDF)
    * `Chart.js` (Visualisasi Data Dashboard)
* **Tools Lain:** Composer, Git, VS Code

---

## 🚀 Memulai (Getting Started)

Ingin menjalankan proyek ini di komputer lokal Anda? Ikuti langkah mudah berikut:

### 1. Prasyarat
* Pastikan PHP >= 8.2 terinstal
* Composer terinstal
* Web Server (XAMPP / Laragon)
* Database MySQL

### 2. Instalasi
```bash
# 1. Clone repository ini
git clone [https://github.com/adammiftah/si-agenda.git](https://github.com/adammiftah/si-agenda.git)
cd si-agenda

# 2. Install dependensi PHP
composer install

# 3. Salin konfigurasi environment
cp .env.example .env

# 4. Generate key aplikasi
php artisan key:generate

# 5. Konfigurasi Database (.env)
#    Buka file .env dan sesuaikan:
#    DB_DATABASE=db_agenda
#    DB_USERNAME=root
#    DB_PASSWORD=

# 6. Buat Symlink Storage (PENTING untuk Foto Profil)
php artisan storage:link

# 7. Jalankan migrasi & data dummy
php artisan migrate --seed

# 8. Jalankan server lokal
php artisan serve
```

---

### 3. Akun Demo (Default Seeder)
Gunakan akun berikut untuk masuk ke sistem:
* Admin : admin@gmail.com (admin123)
* Mahasiswa : user@gmail.com (user123)

---

### 🗺️ Roadmap Proyek
* Integrasi Google Calendar
* Notifikasi Pengingat via Email/WhatsApp
* Fitur Absensi Kegiatan via QR Code
* Dark Mode Support
* Mobile App (Flutter/React Native)

---

### 🤝 Ingin Berkontribusi?
Kontribusi Anda sangat kami harapkan untuk pengembangan sistem ini!
**1. Fork repository ini.**
**2. Buat Branch baru (git checkout -b fitur/NamaFiturKeren).**
**3. Commit perubahan Anda (git commit -m 'Menambahkan fitur login medsos').**
**4. Push ke branch Anda (git push origin fitur/NamaFiturKeren).**
**5. Buat Pull Request baru.**

---

## 💌 Kontak & Dukungan
Punya pertanyaan, saran, atau ingin berdiskusi?
##### 📧Email: [adammiftah196@gmail.com] 
##### 💻GitHub: @adam-miftah
