<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserRoleController;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi Manajemen Buku (RBAC Spatie & Breeze)
|--------------------------------------------------------------------------
|
| Matriks Hak Akses:
| - Admin: Login/Logout, Lihat buku, Tambah buku, Edit buku, Hapus buku, Kelola role pengguna
| - Dosen: Login/Logout, Lihat buku, Tambah buku, Edit buku
| - Mahasiswa: Login/Logout, Lihat buku
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Utama (Terlindungi Autentikasi)
Route::get('/dashboard', function () {
    $totalBuku = Book::count();
    $totalStok = Book::sum('stok');
    $totalUser = User::count();
    $recentBooks = Book::with('user')->latest()->take(5)->get();

    return view('dashboard', compact('totalBuku', 'totalStok', 'totalUser', 'recentBooks'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute Terlindungi Autentikasi
Route::middleware('auth')->group(function () {
    // 1. CRUD Buku (Dilindungi Policy & Spatie Permissions di level controller)
    Route::resource('books', BookController::class);

    // 2. Kelola Role Pengguna (Khusus Admin SAJA: dilindungi middleware & server check)
    Route::get('/users', [UserRoleController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:kelola role pengguna');

    Route::patch('/users/{user}/role', [UserRoleController::class, 'update'])
        ->name('users.update-role')
        ->middleware('permission:kelola role pengguna');

    // 3. Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 4. Fitur Kreatif: Quick Role Switcher untuk Demonstrasi Video Pengujian (Local Env)
    Route::post('/demo/switch-role', function (\Illuminate\Http\Request $request) {
        $roleTarget = $request->input('role');
        $email = match($roleTarget) {
            'Admin' => 'admin@gmail.com',
            'Dosen' => 'dosen@gmail.com',
            'Mahasiswa' => 'mahasiswa@gmail.com',
            default => null,
        };

        if ($email && $user = User::where('email', $email)->first()) {
            \Illuminate\Support\Facades\Auth::login($user);
            return redirect()->route('dashboard')
                ->with('success', 'Berhasil beralih ke sesi akun: ' . $user->name . ' (Role: ' . $roleTarget . ')');
        }

        return back()->with('error', 'Akun demo peran ' . $roleTarget . ' tidak ditemukan.');
    })->name('demo.switch-role');
});

require __DIR__.'/auth.php';
