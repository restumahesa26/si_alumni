@extends('layouts.admin')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Data Mahasiswa</h4>
                    <p>Form Menambahkan Data Mahasiswa</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Data Mahasiswa</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Tambah Data</a></li>
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
                        <form action="{{ route('data-mahasiswa.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for='npm'>NPM</label>
                                <input class='form-control @error('npm') is-invalid @enderror' type='text' name='npm' id='npm' placeholder='Masukkan NPM' value='{{ old('npm') }}' required />
                                @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='nama'>Nama</label>
                                <input class='form-control @error('nama') is-invalid @enderror' type='text' name='nama' id='nama' placeholder='Masukkan Nama' value='{{ old('nama') }}' required />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='password'>Password</label>
                                <input class='form-control @error('password') is-invalid @enderror' type='password' name='password' id='password' placeholder='Masukkan Password' value='{{ old('password') }}' required />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='password_confirmation'>Konfirmasi Password</label>
                                <input class='form-control @error('password_confirmation') is-invalid @enderror' type='password' name='password_confirmation' id='password_confirmation' placeholder='Masukkan Konfirmasi Password' value='{{ old('password_confirmation') }}' required />
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='agama'>Agama</label>
                                <select class="form-control" name="agama" id="agama" required>
                                    <option hidden>-- Pilih Agama --</option>
                                    <option value="Islam" @if(old('agama') == 'Islam') selected @endif>Islam</option>
                                    <option value="Kristen" @if(old('agama') == 'Kristen') selected @endif>Kristen</option>
                                    <option value="Hindu" @if(old('agama') == 'Hindu') selected @endif>Hindu</option>
                                    <option value="Buddha" @if(old('agama') == 'Buddha') selected @endif>Budha</option>
                                    <option value="Konghucu" @if(old('agama') == 'Konghucu') selected @endif>Konghucu</option>
                                </select>
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
                                        <input class='form-control @error('tempat_lahir') is-invalid @enderror' type='text' name='tempat_lahir' id='tempat_lahir' placeholder='Masukkan Tempat Lahir' value='{{ old('tempat_lahir') }}' required />
                                        @error('tempat_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <input class='form-control @error('tanggal_lahir') is-invalid @enderror' type='date' name='tanggal_lahir' id='tanggal_lahir' placeholder='Masukkan Tanggal Lahir' value='{{ old('tanggal_lahir') }}' required />
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
                                    <option value='L' @if (old('jenis_kelamin') == 'L')
                                        selected
                                    @endif>Laki-Laki</option>
                                    <option value='P' @if (old('jenis_kelamin') == 'P')
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
                                <input class='form-control @error('alamat') is-invalid @enderror' type='text' name='alamat' id='alamat' placeholder='Masukkan Alamat' value='{{ old('alamat') }}' required />
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
                                        <input class='form-control @error('nama_ayah') is-invalid @enderror' type='text' name='nama_ayah' id='nama_ayah' placeholder='Masukkan Nama Ayah' value='{{ old('nama_ayah') }}' required />
                                        @error('nama_ayah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='nama_ibu'>Nama Ibu</label>
                                        <input class='form-control @error('nama_ibu') is-invalid @enderror' type='text' name='nama_ibu' id='nama_ibu' placeholder='Masukkan Nama Ibu' value='{{ old('nama_ibu') }}' required />
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
                                <input class='form-control @error('alamat_orang_tua') is-invalid @enderror' type='text' name='alamat_orang_tua' id='alamat_orang_tua' placeholder='Masukkan Alamat Orang Tua' value='{{ old('alamat_orang_tua') }}' required />
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
                                        <input class='form-control @error('pekerjaan_ayah') is-invalid @enderror' type='text' name='pekerjaan_ayah' id='pekerjaan_ayah' placeholder='Masukkan Pekerjaan Ayah' value='{{ old('pekerjaan_ayah') }}' required />
                                        @error('pekerjaan_ayah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='pekerjaan_ibu'>Pekerjaan Ibu</label>
                                        <input class='form-control @error('pekerjaan_ayah') is-invalid @enderror' type='text' name='pekerjaan_ibu' id='pekerjaan_ibu' placeholder='Masukkan Pekerjaan Ibu' value='{{ old('pekerjaan_ibu') }}' required />
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
                                <input class='form-control @error('no_hp') is-invalid @enderror' type='text' name='no_hp' id='no_hp' placeholder='Masukkan Nomor Handphone' value='{{ old('no_hp') }}' required />
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for='email'>Email</label>
                                <input class='form-control @error('email') is-invalid @enderror' type='email' name='email' id='email' placeholder='Masukkan Email' value='{{ old('email') }}' required />
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
                                    <option value='A' @if (old('golongan_darah') == 'A')
                                    selected
                                @endif>A</option>
                                    <option value='B' @if (old('golongan_darah') == 'B')
                                    selected
                                @endif>B</option>
                                    <option value='AB' @if (old('golongan_darah') == 'AB')
                                    selected
                                @endif>AB</option>
                                    <option value='O' @if (old('golongan_darah') == 'O')
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
                                        <input class='form-control @error('tinggi_badan') is-invalid @enderror' type='number' name='tinggi_badan' id='tinggi_badan' placeholder='Masukkan Tinggi Badan' value='{{ old('tinggi_badan') }}' required />
                                        @error('tinggi_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for='berat_badan'>Berat Badan</label>
                                        <input class='form-control @error('berat_badan') is-invalid @enderror' type='number' name='berat_badan' id='berat_badan' placeholder='Masukkan Berat Badan' value='{{ old('berat_badan') }}' required />
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
                                <input class='form-control @error('foto') is-invalid @enderror' type='file' name='foto' id='foto' placeholder='Masukkan Foto' value='{{ old('foto') }}' required />
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
