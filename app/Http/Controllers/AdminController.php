<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('role', 'ADMIN')->latest()->get();

        return view('pages.admin.data-admin.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.data-admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|string|max:50|email|unique:users',
            'nama' => 'required|string|max:40',
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'email' => 'Field :attribute harus berupa email',
            'unique' => 'Field :attribute harus unik',
            'confirmed' => 'Konfirmasi password tidak cocok',
        ];

        $this->validate($request, $rules, $customMessages);

        User::create([
            'nama' => $request->nama,
            'role' => 'ADMIN',
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('data-admin.index')->with(['success' => 'Berhasil Menambah Data Admin ' . $request->nama]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);

        return view('pages.admin.data-admin.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules1 = [
            'nama' => 'required|string|max:40',
        ];

        $rules2 = [
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ];

        $rules3 = [
            'email' => 'required|string|max:50|email|unique:users',
        ];

        $customMessages = [
            'required' => 'Field :attribute wajib diisi',
            'string' => 'Field :attribute harus berupa string',
            'max' => 'Field :attribute maksimal :max',
            'email' => 'Field :attribute harus berupa email',
            'unique' => 'Field :attribute harus unik',
        ];

        $this->validate($request, $rules1, $customMessages);

        if ($request->password) {
            $this->validate($request, $rules2, $customMessages);
        }

        $user = User::findOrFail($id);

        if ($request->email != $user->email) {
            $this->validate($request, $rules3, $customMessages);
        }

        $user->nama = $request->nama;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('data-admin.index')->with(['success' => 'Berhasil Mengubah Data Admin ' . $request->nama]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $nama = $item->nama;

        if (Auth::user()->id == $item->id) {
            return redirect()->back()->with(['success' => 'Gagal Menghapus Data Admin ' . $nama]);
        }else {
            $item->delete();

            return redirect()->route('data-admin.index')->with(['success' => 'Berhasil Menghapus Data Admin ' . $nama]);
        }
    }
}
