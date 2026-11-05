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
        $userId = $dosen?->id ?? $admin?->id ?? 1;

        $books = [
            [
                'judul' => 'Pemrograman Web Modern dengan Laravel & Tailwind CSS',
                'penulis' => 'Dr. Dosen Pengajar, M.Kom.',
                'penerbit' => 'Informatika Press',
                'tahun_terbit' => 2024,
                'kategori' => 'Pemrograman',
                'isbn' => '978-602-1234-56-1',
                'stok' => 15,
                'deskripsi' => 'Panduan komprehensif arsitektur MVC, RESTful API, autentikasi modern, dan pembuatan antarmuka responsif.',
                'user_id' => $userId,
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
                'user_id' => $userId,
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
                'user_id' => $userId,
            ],
            [
                'judul' => 'Keamanan Jaringan & Penetrasi Sistem',
                'penulis' => 'Onno W. Purbo, Ph.D.',
                'penerbit' => 'Andi Offset',
                'tahun_terbit' => 2024,
                'kategori' => 'Jaringan & Keamanan',
                'isbn' => '978-623-0102-34-5',
                'stok' => 5,
                'deskripsi' => 'Prinsip kriptografi modern, mitigasi celah keamanan aplikasi web, autentikasi multi-faktor, dan audit forensik digital.',
                'user_id' => $admin?->id ?? $userId,
            ],
            [
                'judul' => 'Machine Learning Praktis untuk Data Science',
                'penulis' => 'Suyanto, S.T., M.Sc.',
                'penerbit' => 'Graha Ilmu',
                'tahun_terbit' => 2023,
                'kategori' => 'Kecerdasan Buatan',
                'isbn' => '978-602-2621-12-8',
                'stok' => 12,
                'deskripsi' => 'Implementasi algoritma klasifikasi, regresi linier, clustering K-Means, dan evaluasi metrik performa model analitik.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Desain Antarmuka & Pengalaman Pengguna (UI/UX)',
                'penulis' => 'Ahmad Zaenudin, M.Ds.',
                'penerbit' => 'Elex Media Komputindo',
                'tahun_terbit' => 2024,
                'kategori' => 'Desain Antarmuka',
                'isbn' => '978-602-0487-11-9',
                'stok' => 7,
                'deskripsi' => 'Metodologi human-centered design, prototyping interaktif, usability testing, dan prinsip hierarki visual aplikasi modern.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Arsitektur Cloud Computing & Microservices',
                'penulis' => 'Bambang Hariyanto, Dr.',
                'penerbit' => 'Informatika Press',
                'tahun_terbit' => 2023,
                'kategori' => 'Rekayasa Perangkat Lunak',
                'isbn' => '978-623-7131-00-4',
                'stok' => 0,
                'deskripsi' => 'Pola desain microservices, containerization Docker, orkestrasi Kubernetes, serta strategi observabilitas sistem terdistribusi.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Konsep Fundamental Sistem Operasi & Virtualisasi',
                'penulis' => 'Abraham Silberschatz, Ph.D.',
                'penerbit' => 'Salemba Teknika',
                'tahun_terbit' => 2021,
                'kategori' => 'Sistem Operasi',
                'isbn' => '978-981-4253-91-8',
                'stok' => 10,
                'deskripsi' => 'Manajemen memori, proses konkurensi, deadlock prevention, file system, dan arsitektur kernel monolitik vs microkernel.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Metodologi Agile & Scrum dalam Rekayasa Perangkat Lunak',
                'penulis' => 'Prof. Richardus Eko Indrajit',
                'penerbit' => 'Pradnya Paramita',
                'tahun_terbit' => 2024,
                'kategori' => 'Rekayasa Perangkat Lunak',
                'isbn' => '978-979-4085-55-2',
                'stok' => 14,
                'deskripsi' => 'Implementasi sprint planning, backlog refinement, retrospektif, CI/CD pipeline, dan kolaborasi tim tangkas.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Deep Learning dengan Python & PyTorch',
                'penulis' => 'Dr. Eng. Anto Satriyo Nugroho',
                'penerbit' => 'Gadjah Mada University Press',
                'tahun_terbit' => 2023,
                'kategori' => 'Kecerdasan Buatan',
                'isbn' => '978-602-3868-72-1',
                'stok' => 0,
                'deskripsi' => 'Arsitektur neural network, convolutional networks untuk visi komputer, transformator, dan pemrosesan bahasa alami.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Pengembangan Aplikasi Mobile Lintas Platform dengan Flutter',
                'penulis' => 'Budi Raharjo, Ir.',
                'penerbit' => 'Modula',
                'tahun_terbit' => 2024,
                'kategori' => 'Pemrograman',
                'isbn' => '978-602-8758-99-1',
                'stok' => 6,
                'deskripsi' => 'Penguasaan bahasa Dart, arsitektur widget reactive, state management Bloc/Provider, dan integrasi backend API.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Clean Code & Prinsip Refactoring Perangkat Lunak',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Penerbit Andi',
                'tahun_terbit' => 2022,
                'kategori' => 'Rekayasa Perangkat Lunak',
                'isbn' => '978-979-2917-89-5',
                'stok' => 18,
                'deskripsi' => 'Prinsip SOLID, penamaan bermakna, fungsi ringkas, penanganan error elegan, dan teknik penulisan kode berkualitas tinggi.',
                'user_id' => $admin?->id ?? $userId,
            ],
            [
                'judul' => 'Pengantar Internet of Things (IoT) & Embedded Systems',
                'penulis' => 'Agus Kurniawan, S.T., M.Kom.',
                'penerbit' => 'Graha Ilmu',
                'tahun_terbit' => 2023,
                'kategori' => 'Jaringan & Keamanan',
                'isbn' => '978-602-2629-33-9',
                'stok' => 4,
                'deskripsi' => 'Protokol MQTT, interfacing sensor Arduino dan ESP32, arsitektur edge computing, dan enkripsi data IoT.',
                'user_id' => $userId,
            ],
            [
                'judul' => 'Matematika Diskrit untuk Ilmu Komputer',
                'penulis' => 'Kenneth H. Rosen, Ph.D.',
                'penerbit' => 'Erlangga Teknika',
                'tahun_terbit' => 2021,
                'kategori' => 'Sains Komputer',
                'isbn' => '978-602-2981-05-3',
                'stok' => 9,
                'deskripsi' => 'Logika proposisi, teori himpunan, relasi dan fungsi, kombinatorika, teori probabilitas diskrit, dan aljabar Boolean.',
                'user_id' => $userId,
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
