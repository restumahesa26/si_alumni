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
        $items = User::where('role', 'ADMIN')->get();

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
        $request->validate([
            'email' => 'required|string|max:255|email|unique:users',
            'nama' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

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
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);
        }

        $user = User::findOrFail($id);

        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|string|max:255|email|unique:users',
            ]);
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
