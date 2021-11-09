<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_kerja', 'tempat_kerja', 'isi', 'lokasi_kerja'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tanya_jawab_loker(){
        return $this->belongsTo(LokerTanyaJawab::class, 'id', 'loker_id');
    }

    public function tanya_jawab_lokers(){
        return $this->hasMany(LokerTanyaJawab::class, 'id', 'loker_id');
    }
}
