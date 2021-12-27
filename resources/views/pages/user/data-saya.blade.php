@extends('layouts.user')

@section('title')
<title>SI Alumni | Data Saya</title>
@endsection

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="fs-lg-6">Data Saya</h1>
                </div>
                @if (Auth::user()->role === 'ALUMNI')
                <div class="col">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('user.cetak-form-data') }}" class="btn btn-lg btn-secondary"
                            target="_blank">Cetak Form Data</a>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('user.cetak-biodata-wisudawan') }}" class="btn btn-lg btn-secondary"
                            target="_blank">Cetak Biodata Wisudawan</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- <section> close ============================-->
<!-- ============================================-->

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="pt-2 pb-2">
    <div class="container">
        <div class="row">
            <div class="p-5">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.data-saya-update-akun') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Akun</h1>
                            </div>
                            <div class="col mx-auto p-3 text-center">
                                <p class="uploadProfile">
                                    <label for="foto">
                                        @if ($user->foto != NULL)
                                        <img src="{{ asset('storage/assets/foto-profil/' . $user->foto) }}"
                                            alt="alumni-profile" width="180px" class="btn" id="foto_url">
                                        @else
                                        <img src="{{ url('frontend/public/assets/img/favicons/apple-touch-icon2.png') }}"
                                            alt="alumni-profile" width="150px" class="btn" id="foto_url">
                                        @endif

                                    </label>
                                    @if (Auth::user()->role !== 'ADMIN')
                                    <label for="foto">
                                        <a class="btn btn-secondary" rel="nofollow">Upload Foto</a>
                                    </label>
                                    <input class="d-none" type="file" name="foto" id="foto">
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-9 d-grid gap-3 pt-3 pb-4">
                                @if (Auth::user()->role !== 'ADMIN')
                                <div>
                                    <label for="npm">NPM</label>
                                    <input class="form-control @error('npm') is-invalid @enderror" name="npm" id="npm"
                                        type="text" placeholder="NPM" value="{{ old('npm', Auth::user()->npm) }}">
                                    @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                                <div>
                                    <label for="nama">Nama</label>
                                    <input class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        id="nama" type="text" placeholder="Nama"
                                        value="{{ old('nama', Auth::user()->nama) }}">
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @if (Auth::user()->role == 'ADMIN')
                                <div>
                                    <label for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        id="email" type="text" placeholder="Email"
                                        value="{{ old('email', Auth::user()->email) }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endif
                                <div>
                                    <label for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        id="password" type="password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="konfirPassword">Konfirmasi Password</label>
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="konfirPassword" id="konfirPassword" type="password"
                                        placeholder="Konfirmasi Password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-secondary" value="Send" name="simpan" type="submit"
                                    aria-expanded="false">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if (Auth::user()->role === 'MAHASISWA' || Auth::user()->role === 'ALUMNI')
        <div class="row">
            <div class="p-5 pt-0">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.data-saya-data-pribadi') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Pribadi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="agama">Agama</label>
                                        <select class="form-select @error('agama') is-invalid @enderror" name="agama"
                                            id="agama">
                                            <option hidden>Agama Anda...</option>
                                            <option value="Islam" @if(old('agama', $user->agama) == 'Islam') selected
                                                @endif>Islam</option>
                                            <option value="Kristen" @if(old('agama', $user->agama) == 'Kristen')
                                                selected @endif>Kristen</option>
                                            <option value="Hindu" @if(old('agama', $user->agama) == 'Hindu') selected
                                                @endif>Hindu</option>
                                            <option value="Buddha" @if(old('agama', $user->agama) == 'Buddha') selected
                                                @endif>Buddha</option>
                                            <option value="Konghucu" @if(old('agama', $user->agama) == 'Konghucu')
                                                selected @endif>Konghucu</option>
                                        </select>
                                        @error('agama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="angkatan">Angkatan</label>
                                        <input class="form-control @error('angkatan') is-invalid @enderror"
                                            name="angkatan" id="angkatan" type="number" placeholder="Angkatan...."
                                            value="{{ old('angkatan', $user->angkatan) }}">
                                        @error('angkatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <input class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            name="tempat_lahir" id="tempat_lahir" type="text"
                                            placeholder="Tempat Lahir Anda...."
                                            value="{{ old('agama', $user->tempat_lahir) }}">
                                        @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" id="tanggal_lahir" type="date"
                                            value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                                        @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" id="jenis_kelamin">
                                        <option hidden>-- Pilih Jenis Kelamin --</option>
                                        <option value="L" @if(old('jenis_kelamin', $user->jenis_kelamin) == 'L')
                                            selected @endif>Laki-laki</option>
                                        <option value="P" @if(old('jenis_kelamin', $user->jenis_kelamin) == 'P')
                                            selected @endif>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                        id="alamat"
                                        placeholder="Alamat Anda...">{{ old('alamat', $user->alamat) }}</textarea>
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="no_hp">Nomor Handphone</label>
                                        <input class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                            id="no_hp" type="number" placeholder="Nomor Handphone Anda...."
                                            value="{{ old('no_hp', $user->no_hp) }}">
                                        @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            id="email" type="email" placeholder="Email Anda..."
                                            value="{{ old('email', $user->users->email) }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="golongan_darah">Golongan Darah</label>
                                        <select class="form-select @error('golongan_darah') is-invalid @enderror"
                                            name="golongan_darah" id="golongan_darah">
                                            <option hidden>-- Pilih Golongan Darah --</option>
                                            <option value="A" @if(old('golongan_darah', $user->golongan_darah) == 'A')
                                                selected @endif>A</option>
                                            <option value="B" @if(old('golongan_darah', $user->golongan_darah) == 'B')
                                                selected @endif>B</option>
                                            <option value="AB" @if(old('golongan_darah', $user->golongan_darah) == 'AB')
                                                selected @endif>AB</option>
                                            <option value="O" @if(old('golongan_darah', $user->golongan_darah) == 'O')
                                                selected @endif>O</option>
                                        </select>
                                        @error('golongan_darah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @if (Auth::user()->role === 'ALUMNI')
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <select class="form-select @error('status') is-invalid @enderror" name="status"
                                            id="status">
                                            <option hidden>Status Anda...</option>
                                            <option value="Kawin" @if(old('status', $user->status) == 'Kawin') selected
                                                @endif>Kawin</option>
                                            <option value="Belum Kawin" @if(old('status', $user->status) == 'Belum Kawin') selected @endif>Belum Kawin</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tinggi_badan">Tinggi Badan</label>
                                        <div class="input-group">
                                            <input class="form-control @error('tinggi_badan') is-invalid @enderror"
                                                name="tinggi_badan" id="tinggi_badan" type="number"
                                                placeholder="Tinggi Badan Anda...."
                                                value="{{ old('tinggi_badan', $user->tinggi_badan) }}">
                                            <span class="input-group-text" id="basic-addon2">CM</span>
                                        </div>
                                        @error('tinggi_badan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="berat_badan">Berat Badan</label>
                                        <div class="input-group">
                                            <input class="form-control @error('berat_badan') is-invalid @enderror"
                                                name="berat_badan" id="berat_badan" type="number"
                                                placeholder="Berat Badan Anda...."
                                                value="{{ old('berat_badan', $user->berat_badan) }}">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                        @error('berat_badan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @if (Auth::user()->role == 'ALUMNI')
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <div>
                                            <label for="asal_slta">Asal SLTA</label>
                                            <input class="form-control @error('asal_slta') is-invalid @enderror"
                                                name="asal_slta" id="asal_slta" type="text"
                                                placeholder="Asal SLTA Anda..."
                                                value="{{ old('asal_slta', $user->asal_slta) }}">
                                        </div>
                                        @error('asal_slta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 pe-3">
                                        <div>
                                            <label for="ipk">IPK</label>
                                            <input class="form-control @error('ipk') is-invalid @enderror" name="ipk"
                                                id="ipk" type="text" placeholder="IPK Anda..."
                                                value="{{ old('ipk', $user->ipk) }}">
                                        </div>
                                        @error('ipk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-secondary" name="simpan" value="Send" type="submit"
                                    aria-expanded="false">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="p-5 pt-0">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.data-saya-data-orang-tua') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Orangtua</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <input class="form-control @error('nama_ayah') is-invalid @enderror"
                                            name="nama_ayah" id="nama_ayah" type="text" placeholder="Nama Ayah Anda...."
                                            value="{{ old('nama_ayah', $user->nama_ayah) }}">
                                        @error('nama_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <input class="form-control @error('nama_ibu') is-invalid @enderror"
                                            name="nama_ibu" id="nama_ibu" type="text" placeholder="Nama Ibu Anda...."
                                            value="{{ old('nama_ibu', $user->nama_ibu) }}">
                                        @error('nama_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="alamat_orang_tua">Alamat Orangtua</label>
                                    <textarea class="form-control @error('alamat_orang_tua') is-invalid @enderror"
                                        name="alamat_orang_tua" id="alamat_orang_tua"
                                        placeholder="Alamat Orangtua Anda...">{{ old('alamat_orang_tua', $user->alamat_orang_tua) }}</textarea>
                                    @error('alamat_orang_tua')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                        <input class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                            name="pekerjaan_ayah" id="pekerjaan_ayah" type="text"
                                            placeholder="Pekerjaan Ayah Anda..."
                                            value="{{ old('pekerjaan_ayah', $user->pekerjaan_ayah) }}">
                                        @error('pekerjaan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <input class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                            name="pekerjaan_ibu" id="pekerjaan_ibu" type="text"
                                            placeholder="Pekerjaan Ibu Anda..."
                                            value="{{ old('pekerjaan_ibu', $user->pekerjaan_ibu) }}">
                                        @error('pekerjaan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-secondary" name="simpan" value="Send" type="submit"
                                    aria-expanded="false">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        @if (Auth::user()->role === 'ALUMNI')
        <div class="row">
            <div class="p-5 pt-0">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.data-saya-data-skripsi') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Skripsi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="judul_skripsi">Judul Skripsi</label>
                                    <textarea class="form-control @error('judul_skripsi') is-invalid @enderror"
                                        name="judul_skripsi"
                                        placeholder="Judul Skripsi Anda...">{{ old('judul_skripsi', $user->judul_skripsi) }}</textarea>
                                    @error('judul_skripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="bobot_sks">Bobot SKS</label>
                                        <div class="input-group">
                                            <input class="form-control @error('bobot_sks') is-invalid @enderror"
                                                name="bobot_sks" id="bobot_sks" type="number" placeholder="Bobot SKS..."
                                                value="{{ old('bobot_sks', $user->bobot_sks) }}">
                                            <span class="input-group-text" id="basic-addon2">SKS</span>
                                        </div>
                                        @error('bobot_sks')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_seminar_proposal">Tanggal Seminar Proposal</label>
                                        <input
                                            class="form-control @error('tanggal_seminar_proposal') is-invalid @enderror"
                                            name="tanggal_seminar_proposal" id="tanggal_seminar_proposal" type="date"
                                            value="{{ old('tanggal_seminar_proposal', $user->tanggal_seminar_proposal) }}">
                                        @error('tanggal_seminar_proposal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tanggal_sidang">Tanggal Sidang</label>
                                        <input class="form-control @error('tanggal_sidang') is-invalid @enderror"
                                            name="tanggal_sidang" id="tanggal_sidang" type="date"
                                            value="{{ old('tanggal_sidang', $user->tanggal_sidang) }}">
                                        @error('tanggal_sidang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_wisuda">Tanggal Wisuda</label>
                                        <input class="form-control @error('tanggal_wisuda') is-invalid @enderror"
                                            name="tanggal_wisuda" id="tanggal_wisuda" type="date"
                                            value="{{ old('tanggal_wisuda', $user->tanggal_wisuda) }}">
                                        @error('tanggal_wisuda')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-secondary" name="simpan" value="Send" type="submit"
                                    aria-expanded="false">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="p-5 pt-0">
                <div class="border rounded-3 border-3 border-primary p-4">
                    <form action="{{ route('user.data-saya-data-bimbingan-skripsi') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Bimbingan Skripsi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="tanggal_mulai_bimbingan">Tanggal Mulai Bimbingan</label>
                                    <input class="form-control @error('tanggal_mulai_bimbingan') is-invalid @enderror"
                                        name="tanggal_mulai_bimbingan" id="tanggal_mulai_bimbingan" type="date"
                                        value="{{ old('tanggal_mulai_bimbingan', $user->tanggal_mulai_bimbingan) }}">
                                    @error('tanggal_mulai_bimbingan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="dosen_pembimbing_1">Dosen Pembimbing 1</label>
                                    <select name="dosen_pembimbing_1" id="dosen_pembimbing_1"
                                        class="form-select @error('dosen_pembimbing_1') is-invalid @enderror" required>
                                        <option hidden>-- Pilih Dosen Pembimbing 1 --</option>
                                        <option value="Drs. Boko Susilo, M.Kom." @if($user->dosen_pembimbing_1 == "Drs.
                                            Boko Susilo, M.Kom.") selected @endif>Drs. Boko Susilo, M.Kom.</option>
                                        <option value="Rusdi Efendi, S.T., M.Kom." @if($user->dosen_pembimbing_1 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Rusdi Efendi, S.T., M.Kom.
                                        </option>
                                        <option value="Desi Andreswari, S.T., M.Cs." @if($user->dosen_pembimbing_1 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Desi Andreswari, S.T., M.Cs.
                                        </option>
                                        <option value="Ernawati, S.T., M.Cs." @if($user->dosen_pembimbing_1 ==
                                            "Ernawati, S.T., M.Cs.") selected @endif>Ernawati, S.T., M.Cs.</option>
                                        <option value="Arie Vatresia, S.T., M.T.I.,Ph.D" @if($user->dosen_pembimbing_1
                                            == "Arie Vatresia, S.T., M.T.I.,Ph.D") selected @endif>Arie Vatresia, S.T.,
                                            M.T.I.,Ph.D</option>
                                        <option value="Funny Farady Coastera, S.Kom., M.T." @if($user->dosen_pembimbing_1 == "Funny Farady Coastera, S.Kom., M.T.") selected
                                            @endif>Funny Farady Coastera, S.Kom., M.T.</option>
                                        <option value="Mochammad Yusa, S.Kom.,M.Kom." @if($user->dosen_pembimbing_1 ==
                                            "Mochammad Yusa, S.Kom.,M.Kom.") selected @endif>Mochammad Yusa,
                                            S.Kom.,M.Kom</option>
                                        <option value="Ruvita Faurina, S.T., M.Eng." @if($user->dosen_pembimbing_1 ==
                                            "Ruvita Faurina, S.T., M.Eng.") selected @endif>Ruvita Faurina, S.T., M.Eng.
                                        </option>
                                        <option value="Widhia Oktoberza, Kz,. S.T., M.Eng." @if($user->dosen_pembimbing_1 == "Widhia Oktoberza, Kz,. S.T., M.Eng.") selected
                                            @endif>Widhia Oktoberza, Kz,. S.T., M.Eng</option>
                                        <option value="Drs. Asahar Johar, M.Kom." @if($user->dosen_pembimbing_1 == "Drs.
                                            Asahar Johar, M.Kom.") selected @endif>Drs. Asahar Johar, M.Kom.</option>
                                        <option value="Dr. Diyah Puspitaningrum, S.T., M.Kom." @if($user->dosen_pembimbing_1 == "Dr. Diyah Puspitaningrum, S.T., M.Kom.") @endif>Dr.
                                            Diyah Puspitaningrum, S.T., M.Kom.</option>
                                        <option value="Aan Erlansari, S.T., M.Eng." @if($user->dosen_pembimbing_1 ==
                                            "Aan Erlansari, S.T., M.Eng.") selected @endif>Aan Erlansari, S.T., M.Eng.
                                        </option>
                                        <option value="Endina Putri Purwandari, S.T., M.Kom." @if($user->dosen_pembimbing_1 == "Endina Putri Purwandari, S.T., M.Kom.") @endif>Endina
                                            Putri Purwandari, S.T., M.Kom.</option>
                                        <option value="Yudi Setiawan, S.T., M.Eng." @if($user->dosen_pembimbing_1 ==
                                            "Yudi Setiawan, S.T., M.Eng.") selected @endif>Yudi Setiawan, S.T., M.Eng.
                                        </option>
                                        <option value="Kurnia Anggriani, S.T., M.T." @if($user->dosen_pembimbing_1 ==
                                            "Kurnia Anggriani, S.T., M.T.") selected @endif>Kurnia Anggriani, S.T., M.T.
                                        </option>
                                        <option value="Ferzha Putra Utama, S.T., M.Eng." @if($user->dosen_pembimbing_1
                                            == "Ferzha Putra Utama, S.T., M.Eng.") selected @endif>Ferzha Putra Utama,
                                            S.T., M.Eng.</option>
                                        <option value="Andang Wijanarko, S.Kom., M.Kom." @if($user->dosen_pembimbing_1
                                            == "Andang Wijanarko, S.Kom., M.Kom.") selected @endif>Andang Wijanarko,
                                            S.Kom., M.Kom.</option>
                                        <option value="Julia Purnama Sari, S.T., M.Kom." @if($user->dosen_pembimbing_1
                                            == "Julia Purnama Sari, S.T., M.Kom.") selected @endif>Julia Purnama Sari,
                                            S.T., M.Kom.</option>
                                        <option value="Nurul Renaningtias, S.T., M.Kom." @if($user->dosen_pembimbing_1
                                            == "Nurul Renaningtias, S.T., M.Kom.") selected @endif>Nurul Renaningtias,
                                            S.T., M.Kom.</option>
                                    </select>
                                    @error('dosen_pembimbing_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="dosen_pembimbing_2">Dosen Pembimbing 2</label>
                                    <select name="dosen_pembimbing_2" id="dosen_pembimbing_2"
                                        class="form-select @error('dosen_pembimbing_2') is-invalid @enderror" required>
                                        <option hidden>-- Pilih Dosen Pembimbing 2 --</option>
                                        <option value="Drs. Boko Susilo, M.Kom." @if($user->dosen_pembimbing_2 == "Drs.
                                            Boko Susilo, M.Kom.") selected @endif>Drs. Boko Susilo, M.Kom.</option>
                                        <option value="Rusdi Efendi, S.T., M.Kom." @if($user->dosen_pembimbing_2 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Rusdi Efendi, S.T., M.Kom.
                                        </option>
                                        <option value="Desi Andreswari, S.T., M.Cs." @if($user->dosen_pembimbing_2 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Desi Andreswari, S.T., M.Cs.
                                        </option>
                                        <option value="Ernawati, S.T., M.Cs." @if($user->dosen_pembimbing_2 ==
                                            "Ernawati, S.T., M.Cs.") selected @endif>Ernawati, S.T., M.Cs.</option>
                                        <option value="Arie Vatresia, S.T., M.T.I.,Ph.D" @if($user->dosen_pembimbing_2
                                            == "Arie Vatresia, S.T., M.T.I.,Ph.D") selected @endif>Arie Vatresia, S.T.,
                                            M.T.I.,Ph.D</option>
                                        <option value="Funny Farady Coastera, S.Kom., M.T." @if($user->dosen_pembimbing_2 == "Funny Farady Coastera, S.Kom., M.T.") selected
                                            @endif>Funny Farady Coastera, S.Kom., M.T.</option>
                                        <option value="Mochammad Yusa, S.Kom.,M.Kom." @if($user->dosen_pembimbing_2 ==
                                            "Mochammad Yusa, S.Kom.,M.Kom.") selected @endif>Mochammad Yusa,
                                            S.Kom.,M.Kom</option>
                                        <option value="Ruvita Faurina, S.T., M.Eng." @if($user->dosen_pembimbing_2 ==
                                            "Ruvita Faurina, S.T., M.Eng.") selected @endif>Ruvita Faurina, S.T., M.Eng.
                                        </option>
                                        <option value="Widhia Oktoberza, Kz,. S.T., M.Eng." @if($user->dosen_pembimbing_2 == "Widhia Oktoberza, Kz,. S.T., M.Eng.") selected
                                            @endif>Widhia Oktoberza, Kz,. S.T., M.Eng</option>
                                        <option value="Drs. Asahar Johar, M.Kom." @if($user->dosen_pembimbing_2 == "Drs.
                                            Asahar Johar, M.Kom.") selected @endif>Drs. Asahar Johar, M.Kom.</option>
                                        <option value="Dr. Diyah Puspitaningrum, S.T., M.Kom." @if($user->dosen_pembimbing_2 == "Dr. Diyah Puspitaningrum, S.T., M.Kom.") @endif>Dr.
                                            Diyah Puspitaningrum, S.T., M.Kom.</option>
                                        <option value="Aan Erlansari, S.T., M.Eng." @if($user->dosen_pembimbing_2 ==
                                            "Aan Erlansari, S.T., M.Eng.") selected @endif>Aan Erlansari, S.T., M.Eng.
                                        </option>
                                        <option value="Endina Putri Purwandari, S.T., M.Kom." @if($user->dosen_pembimbing_2 == "Endina Putri Purwandari, S.T., M.Kom.") @endif>Endina
                                            Putri Purwandari, S.T., M.Kom.</option>
                                        <option value="Yudi Setiawan, S.T., M.Eng." @if($user->dosen_pembimbing_2 ==
                                            "Yudi Setiawan, S.T., M.Eng.") selected @endif>Yudi Setiawan, S.T., M.Eng.
                                        </option>
                                        <option value="Kurnia Anggriani, S.T., M.T." @if($user->dosen_pembimbing_2 ==
                                            "Kurnia Anggriani, S.T., M.T.") selected @endif>Kurnia Anggriani, S.T., M.T.
                                        </option>
                                        <option value="Ferzha Putra Utama, S.T., M.Eng." @if($user->dosen_pembimbing_2
                                            == "Ferzha Putra Utama, S.T., M.Eng.") selected @endif>Ferzha Putra Utama,
                                            S.T., M.Eng.</option>
                                        <option value="Andang Wijanarko, S.Kom., M.Kom." @if($user->dosen_pembimbing_2
                                            == "Andang Wijanarko, S.Kom., M.Kom.") selected @endif>Andang Wijanarko,
                                            S.Kom., M.Kom.</option>
                                        <option value="Julia Purnama Sari, S.T., M.Kom." @if($user->dosen_pembimbing_2
                                            == "Julia Purnama Sari, S.T., M.Kom.") selected @endif>Julia Purnama Sari,
                                            S.T., M.Kom.</option>
                                        <option value="Nurul Renaningtias, S.T., M.Kom." @if($user->dosen_pembimbing_2
                                            == "Nurul Renaningtias, S.T., M.Kom.") selected @endif>Nurul Renaningtias,
                                            S.T., M.Kom.</option>
                                    </select>
                                    @error('dosen_pembimbing_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="dosen_penguji_1">Dosen Penguji 1</label>
                                    <select name="dosen_penguji_1" id="dosen_penguji_1"
                                        class="form-select @error('dosen_penguji_1') is-invalid @enderror" required>
                                        <option hidden>-- Pilih Dosen Pembimbing 1 --</option>
                                        <option value="Drs. Boko Susilo, M.Kom." @if($user->dosen_penguji_1 == "Drs.
                                            Boko Susilo, M.Kom.") selected @endif>Drs. Boko Susilo, M.Kom.</option>
                                        <option value="Rusdi Efendi, S.T., M.Kom." @if($user->dosen_pembimbing_1 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Rusdi Efendi, S.T., M.Kom.
                                        </option>
                                        <option value="Desi Andreswari, S.T., M.Cs." @if($user->dosen_penguji_1 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Desi Andreswari, S.T., M.Cs.
                                        </option>
                                        <option value="Ernawati, S.T., M.Cs." @if($user->dosen_penguji_1 == "Ernawati,
                                            S.T., M.Cs.") selected @endif>Ernawati, S.T., M.Cs.</option>
                                        <option value="Arie Vatresia, S.T., M.T.I.,Ph.D" @if($user->dosen_penguji_1 ==
                                            "Arie Vatresia, S.T., M.T.I.,Ph.D") selected @endif>Arie Vatresia, S.T.,
                                            M.T.I.,Ph.D</option>
                                        <option value="Funny Farady Coastera, S.Kom., M.T." @if($user->dosen_penguji_1
                                            == "Funny Farady Coastera, S.Kom., M.T.") selected @endif>Funny Farady
                                            Coastera, S.Kom., M.T.</option>
                                        <option value="Mochammad Yusa, S.Kom.,M.Kom." @if($user->dosen_penguji_1 ==
                                            "Mochammad Yusa, S.Kom.,M.Kom.") selected @endif>Mochammad Yusa,
                                            S.Kom.,M.Kom</option>
                                        <option value="Ruvita Faurina, S.T., M.Eng." @if($user->dosen_penguji_1 ==
                                            "Ruvita Faurina, S.T., M.Eng.") selected @endif>Ruvita Faurina, S.T., M.Eng.
                                        </option>
                                        <option value="Widhia Oktoberza, Kz,. S.T., M.Eng." @if($user->dosen_penguji_1
                                            == "Widhia Oktoberza, Kz,. S.T., M.Eng.") selected @endif>Widhia Oktoberza,
                                            Kz,. S.T., M.Eng</option>
                                        <option value="Drs. Asahar Johar, M.Kom." @if($user->dosen_penguji_1 == "Drs.
                                            Asahar Johar, M.Kom.") selected @endif>Drs. Asahar Johar, M.Kom.</option>
                                        <option value="Dr. Diyah Puspitaningrum, S.T., M.Kom." @if($user->dosen_penguji_1 == "Dr. Diyah Puspitaningrum, S.T., M.Kom.") selected
                                            @endif>Dr. Diyah Puspitaningrum, S.T., M.Kom.</option>
                                        <option value="Aan Erlansari, S.T., M.Eng." @if($user->dosen_penguji_1 == "Aan
                                            Erlansari, S.T., M.Eng.") selected @endif>Aan Erlansari, S.T., M.Eng.
                                        </option>
                                        <option value="Endina Putri Purwandari, S.T., M.Kom." @if($user->dosen_penguji_1
                                            == "Endina Putri Purwandari, S.T., M.Kom.") selected @endif>Endina Putri
                                            Purwandari, S.T., M.Kom.</option>
                                        <option value="Yudi Setiawan, S.T., M.Eng." @if($user->dosen_penguji_1 == "Yudi
                                            Setiawan, S.T., M.Eng.") selected @endif>Yudi Setiawan, S.T., M.Eng.
                                        </option>
                                        <option value="Kurnia Anggriani, S.T., M.T." @if($user->dosen_penguji_1 ==
                                            "Kurnia Anggriani, S.T., M.T.") selected @endif>Kurnia Anggriani, S.T., M.T.
                                        </option>
                                        <option value="Ferzha Putra Utama, S.T., M.Eng." @if($user->dosen_penguji_1 ==
                                            "Ferzha Putra Utama, S.T., M.Eng.") selected @endif>Ferzha Putra Utama,
                                            S.T., M.Eng.</option>
                                        <option value="Andang Wijanarko, S.Kom., M.Kom." @if($user->dosen_penguji_1 ==
                                            "Andang Wijanarko, S.Kom., M.Kom.") selected @endif>Andang Wijanarko,
                                            S.Kom., M.Kom.</option>
                                        <option value="Julia Purnama Sari, S.T., M.Kom." @if($user->dosen_penguji_1 ==
                                            "Julia Purnama Sari, S.T., M.Kom.") selected @endif>Julia Purnama Sari,
                                            S.T., M.Kom.</option>
                                        <option value="Nurul Renaningtias, S.T., M.Kom." @if($user->dosen_penguji_1 ==
                                            "Nurul Renaningtias, S.T., M.Kom.") selected @endif>Nurul Renaningtias,
                                            S.T., M.Kom.</option>
                                    </select>
                                    @error('dosen_penguji_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="dosen_penguji_2">Dosen Penguji 2</label>
                                    <select name="dosen_penguji_2" id="dosen_penguji_2"
                                        class="form-select @error('dosen_penguji_2') is-invalid @enderror" required>
                                        <option hidden>-- Pilih Dosen Pembimbing 1 --</option>
                                        <option value="Drs. Boko Susilo, M.Kom." @if($user->dosen_penguji_2 == "Drs.
                                            Boko Susilo, M.Kom.") selected @endif>Drs. Boko Susilo, M.Kom.</option>
                                        <option value="Rusdi Efendi, S.T., M.Kom." @if($user->dosen_penguji_2 == "Rusdi
                                            Efendi, S.T., M.Kom.") selected @endif>Rusdi Efendi, S.T., M.Kom.</option>
                                        <option value="Desi Andreswari, S.T., M.Cs." @if($user->dosen_penguji_2 ==
                                            "Rusdi Efendi, S.T., M.Kom.") selected @endif>Desi Andreswari, S.T., M.Cs.
                                        </option>
                                        <option value="Ernawati, S.T., M.Cs." @if($user->dosen_penguji_2 == "Ernawati,
                                            S.T., M.Cs.") selected @endif>Ernawati, S.T., M.Cs.</option>
                                        <option value="Arie Vatresia, S.T., M.T.I.,Ph.D" @if($user->dosen_penguji_2 ==
                                            "Arie Vatresia, S.T., M.T.I.,Ph.D") selected @endif>Arie Vatresia, S.T.,
                                            M.T.I.,Ph.D</option>
                                        <option value="Funny Farady Coastera, S.Kom., M.T." @if($user->dosen_penguji_2
                                            == "Funny Farady Coastera, S.Kom., M.T.") selected @endif>Funny Farady
                                            Coastera, S.Kom., M.T.</option>
                                        <option value="Mochammad Yusa, S.Kom.,M.Kom." @if($user->dosen_penguji_2 ==
                                            "Mochammad Yusa, S.Kom.,M.Kom.") selected @endif>Mochammad Yusa,
                                            S.Kom.,M.Kom</option>
                                        <option value="Ruvita Faurina, S.T., M.Eng." @if($user->dosen_penguji_2 ==
                                            "Ruvita Faurina, S.T., M.Eng.") selected @endif>Ruvita Faurina, S.T., M.Eng.
                                        </option>
                                        <option value="Widhia Oktoberza, Kz,. S.T., M.Eng." @if($user->dosen_penguji_2
                                            == "Widhia Oktoberza, Kz,. S.T., M.Eng.") selected @endif>Widhia Oktoberza,
                                            Kz,. S.T., M.Eng</option>
                                        <option value="Drs. Asahar Johar, M.Kom." @if($user->dosen_penguji_2 == "Drs.
                                            Asahar Johar, M.Kom.") selected @endif>Drs. Asahar Johar, M.Kom.</option>
                                        <option value="Dr. Diyah Puspitaningrum, S.T., M.Kom." @if($user->dosen_penguji_2 == "Dr. Diyah Puspitaningrum, S.T., M.Kom.") selected
                                            @endif>Dr. Diyah Puspitaningrum, S.T., M.Kom.</option>
                                        <option value="Aan Erlansari, S.T., M.Eng." @if($user->dosen_penguji_2 == "Aan
                                            Erlansari, S.T., M.Eng.") selected @endif>Aan Erlansari, S.T., M.Eng.
                                        </option>
                                        <option value="Endina Putri Purwandari, S.T., M.Kom." @if($user->dosen_penguji_2
                                            == "Endina Putri Purwandari, S.T., M.Kom.") selected @endif>Endina Putri
                                            Purwandari, S.T., M.Kom.</option>
                                        <option value="Yudi Setiawan, S.T., M.Eng." @if($user->dosen_penguji_2 == "Yudi
                                            Setiawan, S.T., M.Eng.") selected @endif>Yudi Setiawan, S.T., M.Eng.
                                        </option>
                                        <option value="Kurnia Anggriani, S.T., M.T." @if($user->dosen_penguji_2 ==
                                            "Kurnia Anggriani, S.T., M.T.") selected @endif>Kurnia Anggriani, S.T., M.T.
                                        </option>
                                        <option value="Ferzha Putra Utama, S.T., M.Eng." @if($user->dosen_penguji_2 ==
                                            "Ferzha Putra Utama, S.T., M.Eng.") selected @endif>Ferzha Putra Utama,
                                            S.T., M.Eng.</option>
                                        <option value="Andang Wijanarko, S.Kom., M.Kom." @if($user->dosen_penguji_2 ==
                                            "Andang Wijanarko, S.Kom., M.Kom.") selected @endif>Andang Wijanarko,
                                            S.Kom., M.Kom.</option>
                                        <option value="Julia Purnama Sari, S.T., M.Kom." @if($user->dosen_penguji_2 ==
                                            "Julia Purnama Sari, S.T., M.Kom.") selected @endif>Julia Purnama Sari,
                                            S.T., M.Kom.</option>
                                        <option value="Nurul Renaningtias, S.T., M.Kom." @if($user->dosen_penguji_2 ==
                                            "Nurul Renaningtias, S.T., M.Kom.") selected @endif>Nurul Renaningtias,
                                            S.T., M.Kom.</option>
                                    </select>
                                    @error('dosen_penguji_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="jumlah_sks">Jumlah SKS</label>
                                    <input class="form-control @error('jumlah_sks') is-invalid @enderror"
                                        name="jumlah_sks" id="jumlah_sks" type="number" placeholder="Jumlah SKS Anda..."
                                        value="{{ old('jumlah_sks', $user->jumlah_sks) }}">
                                    @error('jumlah_sks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-secondary" name="simpan" value="Send" type="submit"
                                    aria-expanded="false">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- end of .container-->
</section>
@endsection

@push('addon-script')
<script src="{{ url('js/sweetalert2.all.min.js') }}"></script>
<script>
    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#foto_url').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#foto").change(function () {
        bacaGambar(this);
    });
</script>
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Perhatikan Lagi Field Yang Diisi'
        })
    </script>
@endif

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
