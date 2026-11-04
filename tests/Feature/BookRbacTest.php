<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookRbacTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $dosen;
    protected User $mahasiswa;
    protected Book $sampleBook;

    protected function setUp(): void
    {
        parent::setUp();

        // Siapkan Roles dan Permissions Spatie
        $this->seed(RolePermissionSeeder::class);

        // Akun Admin
        $this->admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@gmail.com',
        ]);
        $this->admin->assignRole('Admin');

        // Akun Dosen
        $this->dosen = User::factory()->create([
            'name' => 'Dosen Test',
            'email' => 'dosen@gmail.com',
        ]);
        $this->dosen->assignRole('Dosen');

        // Akun Mahasiswa
        $this->mahasiswa = User::factory()->create([
            'name' => 'Mahasiswa Test',
            'email' => 'mahasiswa@gmail.com',
        ]);
        $this->mahasiswa->assignRole('Mahasiswa');

        // Buku Sampel
        $this->sampleBook = Book::create([
            'judul' => 'Buku Pengujian RBAC',
            'penulis' => 'Penulis Uji',
            'penerbit' => 'Penerbit Uji',
            'tahun_terbit' => 2024,
            'kategori' => 'Teknologi',
            'isbn' => '978-000-1111-22-3',
            'stok' => 10,
            'deskripsi' => 'Deskripsi buku sampel pengujian.',
            'user_id' => $this->dosen->id,
        ]);
    }

    /**
     * Kriteria 1: Pengguna belum login diarahkan ke halaman login.
     */
    public function test_guest_is_redirected_to_login_when_accessing_protected_pages(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/books')->assertRedirect('/login');
        $this->get('/books/create')->assertRedirect('/login');
        $this->get('/users')->assertRedirect('/login');
    }

    /**
     * Kriteria 2: Login gagal jika password salah, berhasil jika password benar.
     */
    public function test_login_validation(): void
    {
        $responseFail = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => 'passwordsalah',
        ]);
        $responseFail->assertSessionHasErrors();
        $this->assertGuest();

        $responseSuccess = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
        $responseSuccess->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($this->admin);
    }

    /**
     * Kriteria 3: Mahasiswa dapat melihat buku, tetapi ditolak 403 saat akses URL create / edit / delete.
     */
    public function test_mahasiswa_can_view_books_but_forbidden_from_create_edit_delete(): void
    {
        $this->actingAs($this->mahasiswa);

        // Dapat melihat katalog dan detail
        $this->get('/books')->assertOk()->assertSee('Buku Pengujian RBAC');
        $this->get("/books/{$this->sampleBook->id}")->assertOk();

        // Ditolak 403 saat akses URL langsung create dan edit
        $this->get('/books/create')->assertForbidden();
        $this->get("/books/{$this->sampleBook->id}/edit")->assertForbidden();

        // Ditolak 403 saat store
        $this->post('/books', [
            'judul' => 'Buku Ilegal Mahasiswa',
            'penulis' => 'Hacker',
            'penerbit' => 'Darknet',
            'tahun_terbit' => 2024,
            'kategori' => 'Security',
            'isbn' => '978-999-9999-99-9',
            'stok' => 1,
        ])->assertForbidden();

        // Ditolak 403 saat update
        $this->put("/books/{$this->sampleBook->id}", [
            'judul' => 'Judul Diubah Mahasiswa',
            'penulis' => 'Penulis',
            'penerbit' => 'Penerbit',
            'tahun_terbit' => 2024,
            'kategori' => 'Teknologi',
            'isbn' => $this->sampleBook->isbn,
            'stok' => 5,
        ])->assertForbidden();

        // Ditolak 403 saat delete
        $this->delete("/books/{$this->sampleBook->id}")->assertForbidden();

        // Ditolak 403 saat akses kelola role user
        $this->get('/users')->assertForbidden();
    }

    /**
     * Kriteria 4: Dosen dapat menambah dan mengubah buku, tetapi ditolak 403 saat menghapus buku atau kelola role.
     */
    public function test_dosen_can_create_and_update_books_but_forbidden_from_delete_and_manage_roles(): void
    {
        $this->actingAs($this->dosen);

        // Dapat membuka form create
        $this->get('/books/create')->assertOk();

        // Dapat menyimpan buku baru
        $storeResponse = $this->post('/books', [
            'judul' => 'Buku Riset Dosen Baru',
            'penulis' => 'Dr. Dosen',
            'penerbit' => 'Akademia Press',
            'tahun_terbit' => 2024,
            'kategori' => 'Sains',
            'isbn' => '978-111-2222-33-4',
            'stok' => 5,
        ]);
        $storeResponse->assertRedirect('/books');
        $this->assertDatabaseHas('books', ['isbn' => '978-111-2222-33-4']);

        // Dapat membuka form edit
        $this->get("/books/{$this->sampleBook->id}/edit")->assertOk();

        // Dapat mengupdate buku
        $updateResponse = $this->put("/books/{$this->sampleBook->id}", [
            'judul' => 'Buku Pengujian RBAC (Updated by Dosen)',
            'penulis' => 'Penulis Uji',
            'penerbit' => 'Penerbit Uji',
            'tahun_terbit' => 2024,
            'kategori' => 'Teknologi',
            'isbn' => $this->sampleBook->isbn,
            'stok' => 12,
        ]);
        $updateResponse->assertRedirect('/books');
        $this->assertDatabaseHas('books', ['judul' => 'Buku Pengujian RBAC (Updated by Dosen)']);

        // DITOLAK 403 saat mencoba menghapus buku
        $this->delete("/books/{$this->sampleBook->id}")->assertForbidden();

        // DITOLAK 403 saat mencoba mengakses kelola role pengguna
        $this->get('/users')->assertForbidden();
    }

    /**
     * Kriteria 5: Admin memiliki hak penuh (Lihat, Tambah, Edit, Hapus Buku, serta Kelola Role).
     */
    public function test_admin_has_full_access_including_delete_and_role_management(): void
    {
        $this->actingAs($this->admin);

        // Admin dapat melihat form & membuat buku
        $this->get('/books/create')->assertOk();

        // Admin dapat menghapus buku
        $deleteResponse = $this->delete("/books/{$this->sampleBook->id}");
        $deleteResponse->assertRedirect('/books');
        $this->assertDatabaseMissing('books', ['id' => $this->sampleBook->id]);

        // Admin dapat membuka halaman Kelola Role
        $this->get('/users')->assertOk()->assertSee('Kelola Role & Hak Akses Pengguna');

        // Admin dapat mengubah role pengguna lain
        $roleChangeResponse = $this->patch("/users/{$this->mahasiswa->id}/role", [
            'role' => 'Dosen',
        ]);
        $roleChangeResponse->assertRedirect();
        $this->assertTrue($this->mahasiswa->fresh()->hasRole('Dosen'));
    }

    /**
     * Kriteria 6: Logout mengakhiri session sehingga halaman terlindungi tidak lagi dapat diakses.
     */
    public function test_logout_terminates_session(): void
    {
        $this->actingAs($this->admin);

        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertRedirect('/');
        $this->assertGuest();

        // Mengakses kembali halaman terlindungi akan diarahkan ke login
        $this->get('/books')->assertRedirect('/login');
    }
}

