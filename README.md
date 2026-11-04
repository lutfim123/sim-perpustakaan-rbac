# 📚 SIM Perpustakaan & Manajemen Buku (Laravel 12 & Spatie RBAC)

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Spatie Permission](https://img.shields.io/badge/Spatie-Permission_8.x-EC4899?style=for-the-badge)](https://spatie.be/docs/laravel-permission)
[![Pest Tests](https://img.shields.io/badge/Tests-31%20Passed%20(100%25)-10B981?style=for-the-badge&logo=pest&logoColor=white)](https://pestphp.com)
[![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)](LICENSE)

Aplikasi Web **Sistem Informasi Manajemen Perpustakaan dan Manajemen Buku** dengan implementasi sistem autentikasi **Laravel Breeze** dan kontrol akses berbasis peran (**Role-Based Access Control / RBAC**) menggunakan paket **Spatie Laravel Permission**.

Dirancang dengan prinsip **Defense-in-Depth** (keamanan otorisasi berlapis di sisi server melalui Controller Policy, Form Request, dan Route Middleware) sehingga manipulasi rute URL langsung otomatis dicegah.

---

## 🖼️ Tampilan Antarmuka (Screenshots Preview)

> *Letakkan berkas tangkapan layar di direktori `docs/screenshots/` dengan nama berkas sesuai di bawah ini:*

| 1. Landing Page Akademik | 2. Dashboard & Matriks Hak Akses |
| :---: | :---: |
| ![Landing Page](docs/screenshots/01-landing-page.png) | ![Dashboard](docs/screenshots/02-dashboard-rbac.png) |

| 3. Katalog Koleksi Buku | 4. Kelola Role Pengguna (Admin) |
| :---: | :---: |
| ![Katalog Buku](docs/screenshots/03-katalog-buku.png) | ![Kelola Role](docs/screenshots/04-kelola-role.png) |

| 5. Form Tambah / Edit Buku | 6. Halaman Proteksi HTTP 403 Forbidden |
| :---: | :---: |
| ![Form CRUD Buku](docs/screenshots/05-crud-buku.png) | ![Halaman 403](docs/screenshots/06-403-forbidden.png) |

---

## 🛡️ Matriks Hak Akses Sistem (RBAC Matrix)

Sistem menerapkan pembagian hak akses berdasarkan 3 peran pengguna:

| Fitur / Operasi | Admin | Dosen | Mahasiswa | Proteksi Sisi Server (*Server-Side*) | Visibilitas UI (*Blade*) |
| :--- | :---: | :---: | :---: | :--- | :--- |
| **Login / Logout** | ✅ Ya | ✅ Ya | ✅ Ya | Middleware `auth` | Tampil di Navbar / Profile Menu |
| **Lihat Koleksi Buku** | ✅ Ya | ✅ Ya | ✅ Ya | `BookPolicy::viewAny` & `view` | `@can('lihat buku')` |
| **Tambah Buku Baru** | ✅ Ya | ✅ Ya | ❌ Ditolak (403) | `BookPolicy::create` & `StoreBookRequest` | `@can('tambah buku')` |
| **Edit Data Buku** | ✅ Ya | ✅ Ya | ❌ Ditolak (403) | `BookPolicy::update` & `UpdateBookRequest` | `@can('edit buku')` |
| **Hapus Data Buku** | ✅ Ya | ❌ Ditolak (403) | ❌ Ditolak (403) | `BookPolicy::delete` (abort 403) | `@can('hapus buku')` |
| **Kelola Role Pengguna** | ✅ Ya | ❌ Ditolak (403) | ❌ Ditolak (403) | Route Middleware `permission:kelola role pengguna` | `@can('kelola role pengguna')` |

---

## ✨ Fitur Unggulan

- **Autentikasi Modern (Laravel Breeze):** Fitur registrasi, login aman dengan bcrypt, proteksi CSRF, manajemen session ID regenerasi, dan update profil.
- **Pengaturan Role Otomatis:** Setiap pengguna baru yang mendaftar via formulir registrasi otomatis memperoleh peran default `Mahasiswa`.
- **Role Switcher Demo Bar:** Bar navigasi cepat di bagian atas aplikasi untuk beralih sesi login dalam 1 kali klik antara akun Admin, Dosen, dan Mahasiswa (sangat mempermudah demonstrasi dan evaluasi).
- **Interactive Login Demo Pills:** Tombol isi cepat kredensial demo pada form login untuk pengujian instan.
- **Halaman Khusus 403 Forbidden Interaktif:** Halaman penolakan akses bergaya dark-theme yang informatif, menampilkan identitas user aktif dan penyebab pencegahan akses oleh Policy/Middleware.
- **Katalog Buku Responsif:** Fitur pencarian instan (Judul, Penulis, ISBN), filter berdasarkan kategori keilmuan, dan indikator status stok eksemplar real-time.
- **Panel Manajemen Role Pengguna:** Administrator dapat melihat daftar seluruh pengguna terdaftar dan mengubah hak akses/peran mereka secara langsung.

---

## 👥 Akun Uji Coba (Demo Credentials)

> Kata sandi untuk seluruh akun demo di bawah ini adalah: `password`

| Peran (*Role*) | Alamat Email | Nama Lengkap | Jumlah Izin Aktif |
| :--- | :--- | :--- | :---: |
| **Admin** | `admin@gmail.com` | Administrator Sistem | **5 / 5 Izin** |
| **Dosen** | `dosen@gmail.com` | Dr. Dosen Pengajar, M.Kom. | **3 / 5 Izin** |
| **Mahasiswa** | `mahasiswa@gmail.com` | Mahasiswa Berprestasi | **1 / 5 Izin** |

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

### 1. Kebutuhan Sistem
- PHP >= 8.2 (dengan ekstensi `pdo_mysql`, `intl`, `mbstring`, `openssl`)
- Composer >= 2.x
- Node.js >= 18.x & npm
- MySQL / MariaDB Server (Laragon, XAMPP, atau Docker)

### 2. Kloning Repositori
```bash
git clone https://github.com/username-anda/sim-perpustakaan-rbac.git
cd sim-perpustakaan-rbac
```

### 3. Instal Dependensi PHP & JavaScript
```bash
composer install
npm install
npm run build
```

### 4. Konfigurasi Lingkungan (`.env`)
Salin file konfigurasi dan sesuaikan parameter database MySQL Anda:
```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan baris koneksi pada file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrasi & Seeding Database
Jalankan migrasi tabel dan seeding data role, permission, akun demo, serta koleksi buku awal:
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Aplikasi
```bash
php artisan serve
```
Akses aplikasi melalui peramban: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🧪 Pengujian Otomatis (Automated Testing)

Aplikasi dilengkapi dengan test suite lengkap berbasis **Pest PHP** yang menguji seluruh skenario autentikasi, otorisasi, operasi CRUD, dan penolakan akses ilegal (HTTP 403):

```bash
php artisan test
```

Hasil eksekusi:
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

  Tests:    31 passed (108 assertions)
  Duration: 2.86s
```

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

- **Backend:** Laravel 12 (PHP 8.4)
- **Authentication:** Laravel Breeze (Blade Stack)
- **Authorization & RBAC:** Spatie Laravel Permission 8.x
- **Frontend / Styling:** Tailwind CSS 4.x, Alpine.js, Vite
- **Database:** MySQL 8.x
- **Testing:** Pest PHP

---

## 📄 Lisensi
Proyek ini dilisensikan di bawah lisensi [MIT](LICENSE).
