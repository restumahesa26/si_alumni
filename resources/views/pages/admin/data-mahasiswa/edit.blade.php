@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Ubah Data Mahasiswa</h4>
                    <p>Form Mengubah Data Mahasiswa</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Data Mahasiswa</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Ubah Data</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->nama }}</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('data-mahasiswa.index') }}" class="btn btn-warning btn-sm mr-2 text-white">
                            <i class="ti-angle-double-left"></i> Back
                        </a>
                    </div>
                    <div class="card-body px-4">
                        <form action="{{ route('data-mahasiswa.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for='npm'>NPM</label>
                                <input class='form-control @error('npm') is-invalid @enderror' type='text' name='npm' id='npm' placeholder='Masukkan NPM' value='{{ $item->users->npm }}' required />
                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='nama'>Nama</label>
                                <input class='form-control @error('nama') is-invalid @enderror' type='text' name='nama' id='nama' placeholder='Masukkan Nama' value='{{ $item->users->nama }}' required />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='password'>Password</label>
                                <input class='form-control @error('password') is-invalid @enderror' type='password' name='password' id='password' placeholder='Masukkan Password' value='{{ old('password') }}' />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='password_confirmation'>Konfirmasi Password</label>
                                <input class='form-control @error('password_confirmation') is-invalid @enderror' type='password' name='password_confirmation' id='password_confirmation' placeholder='Masukkan Konfirmasi Password' value='{{ old('password_confirmation') }}' />
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='agama'>Agama</label>
                                <input class='form-control @error('agama') is-invalid @enderror' type='text' name='agama' id='agama' placeholder='Masukkan Agama' value='{{ $item->agama }}' required />
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='tempat_lahir'>Tempat, Tanggal Lahir</label>
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <input class='form-control @error('tempat_lahir') is-invalid @enderror' type='text' name='tempat_lahir' id='tempat_lahir' placeholder='Masukkan Tempat Lahir' value='{{ $item->tempat_lahir }}' required />
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <input class='form-control @error('tanggal_lahir') is-invalid @enderror' type='date' name='tanggal_lahir' id='tanggal_lahir' placeholder='Masukkan Tanggal Lahir' value='{{ $item->tanggal_lahir }}' required />
                                        @error('tanggal_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='jenis_kelamin'>Jenis Kelamin</label>
                                <select class='form-control @error('jenis_kelamin') is-invalid @enderror' name='jenis_kelamin' id='jenis_kelamin' required>
                                    <option value=''>--Pilih Jenis Kelamin--</option>
                                    <option value='L' @if ($item->jenis_kelamin == 'L')
                                        selected
                                    @endif>Laki-Laki</option>
                                    <option value='P' @if ($item->jenis_kelamin == 'P')
                                    selected
                                @endif>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='alamat'>Alamat</label>
                                <input class='form-control @error('alamat') is-invalid @enderror' type='text' name='alamat' id='alamat' placeholder='Masukkan Alamat' value='{{ $item->alamat }}' required />
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='nama_ayah'>Nama Ayah</label>
                                        <input class='form-control @error('nama_ayah') is-invalid @enderror' type='text' name='nama_ayah' id='nama_ayah' placeholder='Masukkan Nama Ayah' value='{{ $item->nama_ayah }}' required />
                                        @error('nama_ayah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='nama_ibu'>Nama Ibu</label>
                                        <input class='form-control @error('nama_ibu') is-invalid @enderror' type='text' name='nama_ibu' id='nama_ibu' placeholder='Masukkan Nama Ibu' value='{{ $item->nama_ibu }}' required />
                                        @error('nama_ibu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='alamat_orang_tua'>Alamat Orang Tua</label>
                                <input class='form-control @error('alamat_orang_tua') is-invalid @enderror' type='text' name='alamat_orang_tua' id='alamat_orang_tua' placeholder='Masukkan Alamat Orang Tua' value='{{ $item->alamat_orang_tua }}' required />
                                @error('alamat_orang_tua')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='pekerjaan_ayah'>Pekerjaan Ayah</label>
                                        <input class='form-control @error('pekerjaan_ayah') is-invalid @enderror' type='text' name='pekerjaan_ayah' id='pekerjaan_ayah' placeholder='Masukkan Pekerjaan Ayah' value='{{ $item->pekerjaan_ayah }}' required />
                                        @error('pekerjaan_ayah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='pekerjaan_ibu'>Pekerjaan Ibu</label>
                                        <input class='form-control @error('pekerjaan_ayah') is-invalid @enderror' type='text' name='pekerjaan_ibu' id='pekerjaan_ibu' placeholder='Masukkan Pekerjaan Ibu' value='{{ $item->pekerjaan_ibu }}' required />
                                        @error('pekerjaan_ibu')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='no_hp'>Nomor Handphone</label>
                                <input class='form-control @error('no_hp') is-invalid @enderror' type='text' name='no_hp' id='no_hp' placeholder='Masukkan Nomor Handphone' value='{{ $item->no_hp }}' required />
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='email'>Email</label>
                                <input class='form-control @error('email') is-invalid @enderror' type='email' name='email' id='email' placeholder='Masukkan Email' value='{{ $item->users->email }}' required />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='golongan_darah'>Golongan Darah</label>
                                <select class='form-control @error('golongan_darah') is-invalid @enderror' name='golongan_darah' id='golongan_darah' required>
                                    <option value=''>--Pilih Golongan Darah--</option>
                                    <option value='A' @if ($item->golongan_darah == 'A')
                                    selected
                                @endif>A</option>
                                    <option value='B' @if ($item->golongan_darah == 'B')
                                    selected
                                @endif>B</option>
                                    <option value='AB' @if ($item->golongan_darah == 'AB')
                                    selected
                                @endif>AB</option>
                                    <option value='O' @if ($item->golongan_darah == 'O')
                                    selected
                                @endif>O</option>
                                </select>
                                @error('golongan_darah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='tinggi_badan'>Tinggi Badan</label>
                                        <input class='form-control @error('tinggi_badan') is-invalid @enderror' type='number' name='tinggi_badan' id='tinggi_badan' placeholder='Masukkan Tinggi Badan' value='{{ $item->tinggi_badan }}' required />
                                        @error('tinggi_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='berat_badan'>Berat Badan</label>
                                        <input class='form-control @error('berat_badan') is-invalid @enderror' type='number' name='berat_badan' id='berat_badan' placeholder='Masukkan Berat Badan' value='{{ $item->berat_badan }}' required />
                                        @error('berat_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for='foto'>Foto</label>
                                <input class='form-control @error('foto') is-invalid @enderror' type='file' name='foto' id='foto' placeholder='Masukkan Foto' value='{{ old('foto') }}' />
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type='submit' class='btn btn-primary btn-block py-2'>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Mahasiswa') }} {{ $item->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-8 py-8">
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('data-mahasiswa.update', $item->id) }}" class="w-full" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="npm" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                NPM
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="npm" value="{{ $item->npm }}" placeholder="Masukkan NPM" name="npm">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="username" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Username
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="username" value="{{ $item->users->username }}" placeholder="Masukkan Username" name="username">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="password" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Password
                            </label>
                            <input type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password" value="{{ old('password') }}" placeholder="Masukkan Password" name="password">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="password_confirmation" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Konfirmasi Password
                            </label>
                            <input type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Password" name="password_confirmation">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="nama" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="nama" value="{{ $item->nama }}" placeholder="Masukkan Nama Lengkap" name="nama">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="jenis_kelamin" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Jenis Kelamin
                            </label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="L" @if ($item->jenis_kelamin === 'L')
                                    selected
                                @endif>Laki-Laki</option>
                                <option value="P" @if ($item->jenis_kelamin === 'P')
                                    selected
                                @endif>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="alamat" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Alamat
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="alamat" value="{{ $item->alamat }}" placeholder="Masukkan Alamat" name="alamat">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="no_hp" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                No HP
                            </label>
                            <input type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="no_hp" value="{{ $item->no_hp }}" placeholder="Masukkan No HP" name="no_hp">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="email" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                Email
                            </label>
                            <input type="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="email" value="{{ $item->users->email }}" placeholder="Masukkan Email" name="email">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-center">
                            <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> --}}
