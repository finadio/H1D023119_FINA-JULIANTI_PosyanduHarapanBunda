# Posyandu Harapan Bunda

Aplikasi manajemen layanan Posyandu (anak, ibu hamil, lansia) berbasis web.

![Versi](https://img.shields.io/badge/version-2.0.0-blue.svg)
![Tahun](https://img.shields.io/badge/updated-2025-green.svg)

Sistem Informasi Posyandu yang diperbarui untuk tahun 2025 dengan fitur-fitur terkini.

## Teknologi
- Laravel (PHP)
- MySQL/MariaDB
- Node.js & Vite (opsional, untuk aset frontend)

## Prasyarat
- PHP 8.x dan Composer
- MySQL/MariaDB
- Node.js (opsional)

## Instalasi
```bash
# 1) Clone repo
git clone https://github.com/finadio/PosyanduHarapanBunda.git
cd PosyanduHarapanBunda

# 2) Salin env dan atur konfigurasi database
copy .env.example .env
# Edit .env -> DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 3) Install dependency backend
composer install

# 4) Generate app key
php artisan key:generate

# 5) Migrasi dan seeding (opsional)
php artisan migrate --seed

# 6) (Opsional) Install dependency frontend dan build
npm install
npm run build
```

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
