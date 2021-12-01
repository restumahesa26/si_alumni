<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_kerja', 'tempat_kerja', 'isi', 'lokasi_kerja', 'status', 'logo_perusahaan'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tanya_jawab_loker(){
        return $this->hasMany(LokerTanyaJawab::class, 'loker_id', 'id');
    }
}
