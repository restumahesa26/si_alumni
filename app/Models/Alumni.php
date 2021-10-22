<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'npm', 'nama', 'agama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'nama_ayah', 'nama_ibu', 'alamat_orang_tua', 'pekerjaan_ayah', 'pekerjaan_ibu', 'no_hp', 'golongan_darah', 'tinggi_badan', 'berat_badan', 'status', 'judul_skripsi', 'asal_slta', 'tanggal_wisuda', 'tanggal_sidang', 'bobot_sks', 'tanggal_seminar_proposal', 'tanggal_mulai_bimbingan', 'dosen_pembimbing_1', 'dosen_pembimbing_2', 'dosen_penguji_1', 'dosen_penguji_2', 'jumlah_sks', 'foto'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
