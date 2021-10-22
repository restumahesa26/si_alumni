<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'isi', 'thumbnail'
    ];

    public function komentar_berita(){
        return $this->belongsTo(BeritaKomentar::class, 'id', 'berita_id');
    }

    public function komentar_beritas(){
        return $this->hasMany(BeritaKomentar::class, 'id', 'berita_id');
    }
}
