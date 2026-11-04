<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'isbn',
        'stok',
        'deskripsi',
        'user_id',
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
        'stok' => 'integer',
    ];

    /**
     * Relasi ke pengguna yang menambahkan buku ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
