# 📚 SIM Perpustakaan - Sistem Manajemen Buku & RBAC

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Spatie Permission](https://img.shields.io/badge/Spatie-Permission_8.x-EC4899?style=for-the-badge)](https://spatie.be/docs/laravel-permission)
[![Pest Tests](https://img.shields.io/badge/Tests-31%20Passed%20(100%25)-10B981?style=for-the-badge&logo=pest&logoColor=white)](https://pestphp.com)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

Aplikasi web modern **Sistem Informasi Manajemen Perpustakaan** dengan arsitektur kontrol akses berbasis peran (**Role-Based Access Control / RBAC**) menggunakan **Spatie Laravel Permission** dan autentikasi **Laravel Breeze**. Antarmuka dirancang dengan gaya admin/SaaS minimalis yang bersih, rapi, dan responsif.

Dibangun dengan prinsip keamanan **Defense-in-Depth** (validasi otorisasi di sisi server melalui Controller Policy, Form Request, dan Route Middleware) untuk memastikan integritas data dan hak akses pengguna.

---

## 🖼️ Tampilan Antarmuka (Screenshots)

> Berkas tangkapan layar tersimpan pada folder `docs/screenshots/`:

| 1. Landing Page | 2. Dashboard Ringkas |
| :---: | :---: |
| ![Landing Page](docs/screenshots/01-landing-page.png) | ![Dashboard](docs/screenshots/02-dashboard-rbac.png) |

| 3. Katalog Buku | 4. Kelola Peran Pengguna (Admin) |
| :---: | :---: |
| ![Katalog Buku](docs/screenshots/03-katalog-buku.png) | ![Kelola Role](docs/screenshots/04-kelola-role.png) |

| 5. Formulir & Detail Buku | 6. Halaman Penolakan Akses (403) |
| :---: | :---: |
| ![Form Buku](docs/screenshots/05-crud-buku.png) | ![Halaman 403](docs/screenshots/06-403-forbidden.png) |

---

## 🛡️ Matriks Hak Akses Sistem (RBAC Matrix)

Sistem mengelola hak akses berdasarkan tiga peran pengguna: **Admin**, **Dosen**, dan **Mahasiswa**.

| Fitur / Operasi | Admin | Dosen | Mahasiswa | Proteksi Sisi Server (*Server-Side*) | Visibilitas UI (*Blade*) |
| :--- | :---: | :---: | :---: | :--- | :--- |
| **Login / Logout** | Ya | Ya | Ya | Middleware `auth` | Tampil di Topbar / Navigasi |
| **Lihat Koleksi Buku** | Ya | Ya | Ya | `BookPolicy::viewAny` & `view` | `@can('lihat buku')` |
| **Tambah Buku Baru** | Ya | Ya | Ditolak (403) | `BookPolicy::create` & `StoreBookRequest` | `@can('tambah buku')` |
| **Edit Data Buku** | Ya | Ya | Ditolak (403) | `BookPolicy::update` & `UpdateBookRequest` | `@can('edit buku')` |
| **Hapus Data Buku** | Ya | Ditolak (403) | Ditolak (403) | `BookPolicy::delete` (abort 403) | `@can('hapus buku')` |
| **Kelola Peran Pengguna** | Ya | Ditolak (403) | Ditolak (403) | Route Middleware `permission:kelola role pengguna` | `@can('kelola role pengguna')` |

---

## ✨ Fitur Utama

- **Desain Antarmuka SaaS Minimalis:** Layout responsif dengan sidebar desktop, drawer mobile Alpine.js, palette warna netral (Slate) dengan aksen Indigo, serta hierarki visual yang jelas.
- **Role-Based Access Control (RBAC):** Pemisahan izin granular (`lihat buku`, `tambah buku`, `edit buku`, `hapus buku`, `kelola role pengguna`) melalui Spatie Laravel Permission.
- **Katalog & Pencarian Buku:** Pencarian cepat berdasarkan judul, pengarang, dan ISBN, serta penyaringan kategori dalam satu baris ringkas.
- **Konfirmasi Hapus Interaktif:** Dialog konfirmasi hapus berbasis Alpine.js menggantikan confirm bawaan browser.
- **Manajemen Akun Pengguna:** Halaman khusus Administrator untuk melihat dan mengubah peran pengguna secara instan.
- **Notifikasi Cerdas (`<x-alert>`):** Flash message dengan auto-dismiss berbasis Alpine.js dan tombol tutup manual.
- **Penetapan Peran Otomatis:** Pengguna yang mendaftar melalui registrasi mandiri otomatis memperoleh peran `Mahasiswa`.
- **Halaman Penolakan Akses (HTTP 403):** Tampilan error 403 yang bersih dan informatif untuk upaya akses di luar kewenangan peran.

---

## 👥 Akun Uji Coba (Demo Credentials)

> Kata sandi untuk seluruh akun demo di bawah ini adalah: `password`

| Peran (*Role*) | Alamat Email | Kata Sandi | Cakupan Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `password` | Akses penuh (Katalog, Tambah, Edit, Hapus, dan Kelola Peran Pengguna) |
| **Dosen** | `dosen@gmail.com` | `password` | Manajemen Buku (Melihat katalog, menambah koleksi, mengedit data buku) |
| **Mahasiswa** | `mahasiswa@gmail.com` | `password` | Read-only (Melihat daftar katalog dan rincian detail buku) |

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

### 1. Kebutuhan Lingkungan
- PHP >= 8.2 (ekstensi `pdo_mysql`, `intl`, `mbstring`, `openssl`)
- Composer >= 2.x
- Node.js >= 18.x & npm
- Database MySQL Server (Laragon, XAMPP, atau Docker)

### 2. Kloning Repositori
```bash
git clone https://github.com/lutfim123/sim-perpustakaan-rbac.git
cd sim-perpustakaan-rbac
```

### 3. Instal Dependensi
```bash
composer install
npm install
npm run build
```

### 4. Konfigurasi Lingkungan (`.env`)
Salin berkas konfigurasi lingkungan dan hasilkan Application Key:
```bash
cp .env.example .env
php artisan key:generate
```

Sesuaikan pengaturan koneksi database pada berkas `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi & Seeding Data
Jalankan migrasi tabel database dan seeder bawaan (role, permission, akun demo, serta katalog 14 buku):
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Aplikasi
```bash
php artisan serve
```
Buka peramban dan akses alamat: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧪 Pengujian Otomatis (Automated Testing)

Proyek ini telah dilengkapi dengan rangkaian pengujian otomatis menggunakan **Pest PHP**, mencakup skenario autentikasi, otorisasi peran, validasi formulir, dan proteksi rute (HTTP 403):

```bash
php artisan test
```

Hasil eksekusi test suite:
```text
   PASS  Tests\Feature\Auth\AuthenticationTest
   PASS  Tests\Feature\Auth\EmailVerificationTest
   PASS  Tests\Feature\Auth\PasswordConfirmationTest
   PASS  Tests\Feature\Auth\PasswordResetTest
   PASS  Tests\Feature\Auth\PasswordUpdateTest
   PASS  Tests\Feature\Auth\RegistrationTest
   PASS  Tests\Feature\BookRbacTest
   PASS  Tests\Feature\ExampleTest
   PASS  Tests\Feature\ProfileTest
   PASS  Tests\Unit\ExampleTest

  Tests:    31 passed (108 assertions)
  Duration: 25.4s
```

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

- **Backend:** Laravel 12 (PHP 8.4)
- **Autentikasi:** Laravel Breeze (Blade Stack)
- **Otorisasi & RBAC:** Spatie Laravel Permission 8.x
- **Frontend / Styling:** Tailwind CSS 3.x, Alpine.js, Vite
- **Database:** MySQL 8.x
- **Testing:** Pest PHP

---

## 📄 Lisensi
Proyek ini didistribusikan di bawah lisensi [MIT](LICENSE).
