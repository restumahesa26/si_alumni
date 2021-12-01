<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'isi', 'thumbnail', 'is_populer'
    ];

    public function komentar_berita(){
        return $this->hasMany(BeritaKomentar::class, 'berita_id', 'id');
    }
}
