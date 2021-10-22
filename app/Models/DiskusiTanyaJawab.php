<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskusiTanyaJawab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'diskusi_id', 'tanya_jawab'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function diskusis(){
        return $this->hasOne(Diskusi::class, 'id', 'diskusi_id');
    }

    public function diskusi(){
        return $this->belongsToMany(Diskusi::class, 'id', 'diskusi_id');
    }
}
