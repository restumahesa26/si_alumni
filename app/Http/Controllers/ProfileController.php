<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);

        return view('pages.admin.profile', [
            'item' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        if ($request->email != $user->email || $request->npm != $user->npm) {
            $request->validate([
                'email' => 'required|string|max:255|email|unique:users',
                'npm' => 'required|string|max:255|unique:users'
            ]);
        }

        $user->nama = $request->nama;
        $user->npm = $request->npm;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('dashboard');
    }
}
