<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = User::where('email', 'dosen@gmail.com')->first();
        $admin = User::where('email', 'admin@gmail.com')->first();

        $books = [
            [
                'judul' => 'Pemrograman Web Lanjut dengan Laravel & Vue.js',
                'penulis' => 'Dr. Dosen Pengajar, M.Kom.',
                'penerbit' => 'Informatika Press',
                'tahun_terbit' => 2024,
                'kategori' => 'Pemrograman',
                'isbn' => '978-602-1234-56-1',
                'stok' => 15,
                'deskripsi' => 'Panduan komprehensif arsitektur MVC, RESTful API, autentikasi Breeze, dan Role-Based Access Control (RBAC) pada framework Laravel modern.',
                'user_id' => $dosen?->id ?? $admin?->id,
            ],
            [
                'judul' => 'Struktur Data & Algoritma Tingkat Lanjut',
                'penulis' => 'Prof. Rinaldi Munir',
                'penerbit' => 'Gava Media',
                'tahun_terbit' => 2023,
                'kategori' => 'Sains Komputer',
                'isbn' => '978-602-8765-43-2',
                'stok' => 8,
                'deskripsi' => 'Membahas graf, pohon biner, kompleksitas algoritma Big-O, pemecahan masalah rekursif, dan optimasi struktur memori.',
                'user_id' => $dosen?->id ?? $admin?->id,
            ],
            [
                'judul' => 'Sistem Manajemen Basis Data Relasional & NoSQL',
                'penulis' => 'Fathansyah, Ir.',
                'penerbit' => 'Informatika Bandung',
                'tahun_terbit' => 2022,
                'kategori' => 'Basis Data',
                'isbn' => '978-979-1153-89-0',
                'stok' => 20,
                'deskripsi' => 'Konsep dasar basis data, normalisasi tabel 1NF-BCNF, SQL tingkat lanjut, indexing, trigger, dan transaksi ACID.',
                'user_id' => $dosen?->id ?? $admin?->id,
            ],
            [
                'judul' => 'Keamanan Siber dan Etika Hacking (Cybersecurity)',
                'penulis' => 'Onno W. Purbo, Ph.D.',
                'penerbit' => 'Andi Offset',
                'tahun_terbit' => 2024,
                'kategori' => 'Jaringan & Keamanan',
                'isbn' => '978-623-0102-34-5',
                'stok' => 5,
                'deskripsi' => 'Prinsip kriptografi, mitigasi celah keamanan OWASP Top 10, autentikasi multi-faktor, dan audit forensik digital.',
                'user_id' => $admin?->id,
            ],
            [
                'judul' => 'Machine Learning Praktis untuk Analisis Data',
                'penulis' => 'Suyanto, S.T., M.Sc.',
                'penerbit' => 'Graha Ilmu',
                'tahun_terbit' => 2023,
                'kategori' => 'Kecerdasan Buatan',
                'isbn' => '978-602-2621-12-8',
                'stok' => 12,
                'deskripsi' => 'Implementasi algoritma klasifikasi, regresi linier, clustering K-Means, dan evaluasi metrik performa model data.',
                'user_id' => $dosen?->id ?? $admin?->id,
            ],
        ];

        foreach ($books as $bookData) {
            Book::updateOrCreate(
                ['isbn' => $bookData['isbn']],
                $bookData
            );
        }
    }
}

