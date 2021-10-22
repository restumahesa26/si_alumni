<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
        'npm',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alumni(){
        return $this->belongsTo(Alumni::class, 'id', 'user_id');
    }

    public function alumnis(){
        return $this->hasOne(Alumni::class, 'id', 'user_id');
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'id', 'user_id');
    }

    public function mahasiswas(){
        return $this->hasOne(Mahasiswa::class, 'id', 'user_id');
    }

    public function loker(){
        return $this->belongsTo(Loker::class, 'id', 'user_id');
    }

    public function diskusi(){
        return $this->belongsTo(Diskusi::class, 'id', 'user_id');
    }

    public function tanya_jawab_loker(){
        return $this->belongsTo(LokerTanyaJawab::class, 'id', 'user_id');
    }
}
