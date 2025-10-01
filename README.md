# Sistem Informasi Posyandu Harapan Bunda
## Tampilan Dashboard
![Dashboard](https://github.com/finadio/H1D023119_FINA-JULIANTI_PosyanduHarapanBunda/blob/main/Screenshot%202025-10-01%20193308.png?raw=true)

Selamat datang di repositori Sistem Informasi Posyandu Harapan Bunda! Ini adalah aplikasi berbasis web yang dikembangkan untuk memenuhi tugas mata kuliah **Informatika Medik** di **Universitas Jenderal Soedirman**. Proyek ini bertujuan untuk mendigitalisasi proses pencatatan dan manajemen data di Posyandu Harapan Bunda, Desa Lumbir, yang sebelumnya dilakukan secara manual.

Aplikasi ini dirancang untuk meningkatkan efisiensi pelayanan, memudahkan penelusuran data pasien (ibu hamil, balita, dan lansia), serta menyediakan media informasi digital bagi masyarakat.

- **Live Demo:** [**posyanduhb.free.nf**](https://posyanduhb.free.nf/)
- **Dosen Pengampu:** Dwi Kurnia Wibowo, S.Kom.,M.Kom

## Pengembang
- **Khansa Nur Khalisah** (H1D023106)  
- **Fina Julianti** (H1D023119)  

## Fitur Utama
Aplikasi ini dilengkapi dengan berbagai fitur untuk mendukung operasional Posyandu secara digital:

#### 1. Manajemen Data (Master)
- **Data Pasien:** Mengelola data orang tua, anak-anak, dan lansia secara terstruktur.
- **Data Pengguna:** Mengelola data petugas dan admin yang memiliki akses ke sistem.

#### 2. Manajemen Layanan Kesehatan
- **Imunisasi:** Pencatatan riwayat imunisasi anak, termasuk jenis vaksin dan efek samping.
- **Penimbangan:** Pemantauan data pertumbuhan anak (berat badan, tinggi badan, lingkar kepala).
- **Pemeriksaan Ibu Hamil:** Pencatatan komprehensif hasil pemeriksaan kehamilan.
- **Pemeriksaan Lansia:** Pencatatan data kesehatan peserta lansia seperti tekanan darah, gula darah, dan status gizi.

#### 3. Manajemen Informasi & Komunikasi
- **Jadwal Kegiatan:** Mengelola dan menampilkan jadwal semua kegiatan Posyandu.
- **Artikel Kesehatan:** Media edukasi digital bagi masyarakat yang dapat dikelola oleh admin.
- **Integrasi WhatsApp:** Terdapat tombol akses cepat ke grup WhatsApp dan pusat bantuan.

#### 4. Manajemen Inventaris
- **Persediaan Vaksin:** Mengelola data stok vaksin, termasuk tanggal masuk dan kedaluwarsa.
- **Persediaan Obat:** Mengelola stok obat-obatan yang tersedia di Posyandu.

#### 5. Pengaturan Sistem
- **Autentikasi:** Sistem registrasi dan login yang aman untuk pengguna.
- **Identitas Situs:** Konfigurasi informasi dasar situs seperti nama desa dan kontak resmi.

## Akun Demo
Untuk mencoba aplikasi, gunakan akun berikut:
## **Admin**
- **Username:** admin
- **Password:** 123
## **User**
- **Username:** 5658262510081726
- **Password:** 123

## Teknologi yang Digunakan
- **Backend:** Laravel (PHP)
- **Database:** MySQL / MariaDB
- **Frontend:** Node.js & Vite (opsional, untuk manajemen aset)

## Prasyarat
- PHP 8.x dan Composer  
- MySQL / MariaDB  
- Node.js (opsional, direkomendasikan untuk pengembangan frontend)  

## Instalasi (Lokal)
```bash
# 1. Clone repositori ini
git clone https://github.com/finadio/PosyanduHarapanBunda.git
cd PosyanduHarapanBunda

# 2. Salin file .env.example dan atur konfigurasi database
copy .env.example .env
# Edit file .env dan sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 3. Install dependency backend via Composer
composer install

# 4. Generate application key
php artisan key:generate

# 5. Jalankan migrasi dan seeding (opsional, untuk data awal)
php artisan migrate --seed

# 6. (Opsional) Install dependency frontend dan build aset
npm install
npm run build

## Menjalankan Aplikasi (Local)
php artisan serve


## Menjalankan Aplikasi (Local)
```bash
php artisan serve
```
Akses: `http://127.0.0.1:8000`

## Struktur Direktori Singkat
- `app/` kode aplikasi Laravel
- `routes/` rute aplikasi (`web.php`, `api.php`)
- `resources/views/` tampilan Blade
- `database/` migrasi, seeder, dan factory
- `public/` dokumen publik

## Catatan
- File `.env` tidak ikut dipush. Gunakan `.env.example` sebagai template.
- Sesuaikan versi PHP/ekstensi sesuai kebutuhan Laravel Anda.

## Kontribusi
Pull request dipersilakan. Untuk isu/bug, silakan buat issue di repository.

## Tautan
- Repository: https://github.com/finadio/PosyanduHarapanBunda
