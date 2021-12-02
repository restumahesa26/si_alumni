<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'nama' => 'Mufti Restu Mahesa',
            'email' => 'mufti.restumahesa@gmail.com',
            'role' => 'ADMIN',
            'password' => Hash::make('password')
        ]);
    }
}
