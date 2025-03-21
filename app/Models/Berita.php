<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model

{
    // Mendefinisikan nama tabel terkait
    protected $fillable = [
        'judul', 'isi', 'penulis', 'gambar','kategori',
    ];
}