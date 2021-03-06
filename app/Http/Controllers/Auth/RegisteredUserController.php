<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.user.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:9', 'unique:users', 'min:9'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'min' => 'Field :attribute maksimal :min',
            'digits' => 'Field :attribute harus :digits digit',
            'email' => 'Field :attribute harus berupa email',
            'unique' => 'Field :attribute harus unik',
            'confirmed' => 'Konfirmasi password tidak cocok',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::create([
            'role' => 'MAHASISWA',
            'npm' => $request->npm,
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with(['success-register' => 'Berhasil Daftar Akun']);
    }
}
