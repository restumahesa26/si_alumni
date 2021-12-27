<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'judul', 'isi', 'status'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tanya_jawab_diskusi(){
        return $this->hasMany(DiskusiTanyaJawab::class, 'diskusi_id', 'id')->oldest();
    }
}
