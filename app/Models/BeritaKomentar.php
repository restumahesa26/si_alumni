<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaKomentar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'berita_id', 'komentar'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function beritas(){
        return $this->hasOne(Berita::class, 'id', 'diskusi_id');
    }

    public function berita(){
        return $this->belongsToMany(Berita::class, 'id', 'berita_id');
    }
}
