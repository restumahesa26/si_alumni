<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'npm', 'nama', 'agama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'nama_ayah', 'nama_ibu', 'alamat_orang_tua', 'pekerjaan_ayah', 'pekerjaan_ibu', 'no_hp', 'golongan_darah', 'tinggi_badan', 'berat_badan', 'angkatan'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
