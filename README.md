#  Website Sekolah - Tugas Praktek Sertifikasi Junior Web Programmer

Website resmi Sekolah Menengah Atas Negeri XYX yang dikembangkan sebagai **Tugas Praktek Sertifikasi Junior Web Programmer**.

## 📋 Deskripsi Tugas

Proyek ini merupakan implementasi website informasi sekolah yang menunjukkan penguasaan dasar-dasar pengembangan web menggunakan PHP native. Tugas ini dirancang untuk mengevaluasi kemampuan peserta dalam:

  - Pengembangan website dinamis dengan PHP
  - Implementasi database MySQL
  - Desain responsif dengan HTML, CSS, dan JavaScript
  - Keamanan web dasar
  - Manajemen proyek dengan Composer
  - Implementasi sistem email dengan PHPMailer

## 🎯 Tujuan Pembelajaran

Melalui proyek ini, peserta diharapkan dapat:

  - Menerapkan struktur website yang rapi dan terorganisir
  - Menggunakan PHP untuk membuat halaman dinamis
  - Mengintegrasikan database untuk menyimpan data kontak
  - Menerapkan keamanan dasar website
  - Menggunakan tools modern seperti Composer untuk dependency management
  - Mengimplementasikan sistem notifikasi email

## 🚀 Fitur Utama

  - **Beranda**: Menampilkan informasi utama sekolah
  - **Tentang Kami**: Profil lengkap sekolah
  - **Kegiatan**: Daftar kegiatan sekolah
  - **Berita**: Artikel berita terbaru
  - **Kontak**: Formulir kontak dengan database backend dan notifikasi email

## 🛠️ Teknologi yang Digunakan

### Backend

  - **PHP 8.2.^** - Bahasa pemrograman utama
  - **MySQL** - Database relasional
  - **Phinx** - Database migrations (via Composer)
  - **PHPMailer** - Library untuk mengirim email
  - **PHP dotenv** - Untuk manajemen variabel lingkungan

### Frontend

  - **HTML5** - Struktur konten
  - **CSS3** - Styling dan responsif design
  - **Bootstrap 5** - Kerangka kerja CSS untuk desain responsif
  - **JavaScript** - Interaktivitas client-side

### Tools & Dependencies

  - **Composer** - Dependency management
  - **Git** - Version control
  - **Laragon** - Development environment (Windows)
      - Apache 2.4 - Web server
      - MySQL 8.0 - Database server
      - PHP 8.2.^ - PHP interpreter

## ⚙️ Langkah-langkah Penggunaan

Berikut adalah cara untuk menjalankan proyek ini di lingkungan lokal Anda.

### 1\. Dapatkan Kode Proyek

Clone repositori dari GitHub atau unduh file ZIP dan ekstrak ke direktori lokal Anda.

```bash
git clone [https://github.com/ap-pamungkas/lps-juniorprogrammer.git]
```

### 2\. Instalasi Dependensi

Buka terminal atau command prompt di direktori root proyek dan jalankan perintah berikut untuk menginstal semua dependensi yang diperlukan.

```bash
composer install
```

### 3\. Konfigurasi Database & Lingkungan

1.  Salin file `.env.example` menjadi `.env`.
    ```bash
    cp .env.example .env
    ```
2.  Buka file `.env` dan sesuaikan konfigurasi database (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`) sesuai dengan pengaturan di lingkungan lokal Anda.
3.  Konfigurasikan juga pengaturan SMTP untuk pengiriman email (`EMAIL_HOST`, `EMAIL_USER`, `EMAIL_PASS`, `EMAIL_ADMIN`).
4.  Buat sebuah database baru di MySQL dengan nama yang sama seperti yang Anda atur di `DB_NAME`.

### 4\. Jalankan Migrasi Database

Setelah database dibuat dan dikonfigurasi, jalankan perintah Phinx berikut untuk membuat tabel `pesan_kontak` secara otomatis.

```bash
vendor/bin/phinx migrate
```

### 5\. Jalankan Proyek

Ada dua cara untuk menjalankan proyek ini:

  * **Menggunakan Server Lokal (Laragon/XAMPP):**
    Tempatkan folder proyek di dalam direktori `htdocs` (XAMPP) atau `www` (Laragon), lalu akses melalui browser Anda di alamat `http://localhost/nama-folder-proyek`.

  * **Menggunakan Server Internal PHP:**
    Buka terminal di direktori root proyek dan jalankan perintah berikut:

    ```bash
    php -S localhost:8080
    ```

    Setelah itu, buka browser dan akses `http://localhost:8080`.
