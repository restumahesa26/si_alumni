<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokerTanyaJawab extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'loker_id', 'tanya_jawab'
    ];

    public function users(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lokers(){
        return $this->hasOne(Loker::class, 'id', 'loker_id');
    }

    public function loker(){
        return $this->belongsToMany(Loker::class, 'id', 'loker_id');
    }
}
