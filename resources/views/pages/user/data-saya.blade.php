@extends('layouts.user')

@section('content')
<section class="pb-0">
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-md-between">
                <div class="col">
                    <h1 class="fs-lg-6">Data Saya</h1>
                </div>
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
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Akun</h1>
                            </div>
                            <div class="col mx-auto p-3 text-center">
                                <p class="uploadProfile">
                                    <label for="profile">
                                        <img src="{{ url('frontend/public/assets/img/gallery/macrohard.png') }}" alt="alumni-profile" width="150px"
                                            class="btn">
                                    </label>
                                    <label for="profile">
                                        <a class="btn btn-warning" rel="nofollow">Upload Profil</a>
                                    </label>
                                    <input class="d-none" type="file" name="profile" id="profile">
                                </p>
                            </div>
                            <div class="col-md-9 d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="npm">NPM</label>
                                    <input class="form-control" name="npm" id="npm" type="text" placeholder="NPM" value="{{ Auth::user()->npm }}">
                                </div>
                                <div>
                                    <label for="nama">Nama</label>
                                    <input class="form-control" name="nama" id="nama" type="text" placeholder="Nama" value="{{ $user->nama }}">
                                </div>
                                @if (Auth::user()->role === 'ADMIN')
                                <div>
                                    <label for="email">Email</label>
                                    <input class="form-control" name="email" id="email" type="text" placeholder="Email" value="{{ $user->email }}">
                                </div>
                                @endif
                                <div>
                                    <label for="password">Password</label>
                                    <input class="form-control" name="password" id="password" type="password"
                                        placeholder="Password">
                                </div>
                                <div>
                                    <label for="konfirPassword">Konfirmasi Password</label>
                                    <input class="form-control" name="konfirPassword" id="konfirPassword"
                                        type="password" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-primary" value="Send" name="simpan" type="submit"
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
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Pribadi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div class="d-grid">
                                    <label for="agama">Agama</label>
                                    <select class="form-select" name="agama" id="agama">
                                        <option hidden>Agama Anda...</option>
                                        <option value="Islam" @if($user->agama == 'Islam') selected @endif>Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tempat_lahir">Tempat</label>
                                        <input class="form-control" name="tempat_lahir" id="tempat_lahir" type="text"
                                            placeholder="Tempat Lahir Anda...." value="{{ $user->tempat_lahir }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <input class="form-control" name="tanggal_lahir" id="tanggal_lahir" type="date" value="{{ $user->tanggal_lahir }}">
                                    </div>
                                </div>
                                <div>
                                    <label for="gender">Jenis Kelamin</label>
                                    <select class="form-select" name="gender" id="gender">
                                        <option hidden>-- Pilih Jenis Kelamin --</option>
                                        <option value="L" @if($user->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                                        <option value="P" @if($user->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" id="alamat"
                                        placeholder="Alamat Anda...">{{ $user->alamat }}</textarea>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="no_hp">Nomor Handphone</label>
                                        <input class="form-control" name="no_hp" id="no_hp" type="number"
                                            placeholder="Nomor Handphone Anda...." value="{{ $user->no_hp }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email</label>
                                        <input class="form-control" name="email" id="email" type="email"
                                            placeholder="Email Anda..." value="{{ $user->users->email }}">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="goldar">Golongan Darah</label>
                                        <select class="form-select" name="goldar" id="goldar">
                                            <option hidden>-- Pilih Golongan Darah --</option>
                                            <option value="A" @if($user->golongan_darah == 'A') selected @endif>A</option>
                                            <option value="B" @if($user->golongan_darah == 'B') selected @endif>B</option>
                                            <option value="AB" @if($user->golongan_darah == 'AB') selected @endif>AB</option>
                                            <option value="O" @if($user->golongan_darah == 'O') selected @endif>O</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="status">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option hidden>Status Anda...</option>
                                            <option value="Menikah" @if($user->status == 'Menikah') selected @endif>Menikah</option>
                                            <option value="Belum Menihkah" @if($user->status == 'Belum Menikah') selected @endif>Belum Menikah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tinggi_badan">Tinggi Badan</label>
                                        <div class="input-group">
                                            <input class="form-control" name="tinggi_badan" id="tinggi_badan"
                                                type="number" placeholder="Tinggi Badan Anda...." value="{{ $user->tinggi_badan }}">
                                            <span class="input-group-text" id="basic-addon2">Meter</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="berat_badan">Berat Badan</label>
                                        <div class="input-group">
                                            <input class="form-control" name="berat_badan" id="berat_badan" type="number" placeholder="Berat Badan Anda...." value="{{ $user->berat_badan }}">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="asal_slta">Asal SLTA</label>
                                    <input class="form-control" name="asal_slta" id="asal_slta" type="text"
                                        placeholder="Asal SLTA Anda..." value="{{ $user->asal_slta }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-primary" name="simpan" value="Send" type="submit"
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
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Orangtua</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <input class="form-control" name="nama_ayah" id="nama_ayah" type="text"
                                            placeholder="Nama Ayah Anda...." value="{{ $user->nama_ayah }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <input class="form-control" name="nama_ibu" id="nama_ibu" type="text"
                                            placeholder="Nama Ibu Anda...." value="{{ $user->nama_ibu }}">
                                    </div>
                                </div>
                                <div>
                                    <label for="alamat_orang_tua">Alamat Orangtua</label>
                                    <textarea class="form-control" name="alamat_orang_tua" id="alamat_orang_tua"
                                        placeholder="Alamat Orangtua Anda...">{{ $user->alamat_orang_tua }}</textarea>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                                        <input class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" type="text" placeholder="Pekerjaan Ayah Anda..." value="{{ $user->pekerjaan_ayah }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                                        <input class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu" type="text" placeholder="Pekerjaan Ibu Anda..." value="{{ $user->pekerjaan_ibu }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-primary" name="simpan" value="Send" type="submit"
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
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Skripsi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="judulSkripsi">Judul Skripsi</label>
                                    <textarea class="form-control" name="judulSkripsi"
                                        placeholder="Judul Skripsi Anda..."></textarea>
                                </div>

                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="bobotSKS">Bobot SKS</label>
                                        <div class="input-group">
                                            <input class="form-control" name="bobotSKS" id="bobotSKS" type="number"
                                                placeholder="Bobot SKS...">
                                            <span class="input-group-text" id="basic-addon2">SKS</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tglSemprop">Tanggal Seminar Proposal</label>
                                        <input class="form-control" name="tglSemprop" id="tglSemprop" type="date">
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-md-6 pe-3">
                                        <label for="tglSidang">Tanggal Sidang</label>
                                        <input class="form-control" name="tglSidang" id="tglSidang" type="date">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tglWisuda">Tanggal Wisuda</label>
                                        <input class="form-control" name="tglWisuda" id="tglWisuda" type="date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-primary" name="simpan" value="Send" type="submit"
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
                    <form action="" method="">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>Data Bimbingan Skripsi</h1>
                            </div>
                            <div class="col d-grid gap-3 pt-3 pb-4">
                                <div>
                                    <label for="tglMulaiBimbingan">Tanggal Mulai Bimbingan</label>
                                    <input class="form-control" name="tglMulaiBimbingan" id="tglMulaiBimbingan"
                                        type="date">
                                </div>
                                <div>
                                    <label for="pembimbing1">Dosen Pembimbing 1</label>
                                    <input class="form-control" name="pembimbing1" id="pembimbing1" type="text"
                                        placeholder="Nama Dosen Pembimbing 1">
                                </div>
                                <div>
                                    <label for="pembimbing2">Dosen Pembimbing 2</label>
                                    <input class="form-control" name="pembimbing2" id="pembimbing2" type="text"
                                        placeholder="Nama Dosen Pembimbing 2">
                                </div>
                                <div>
                                    <label for="penguji1">Dosen Penguji 1</label>
                                    <input class="form-control" name="penguji1" id="penguji1" type="text"
                                        placeholder="Nama Dosen Penguji 1">
                                </div>
                                <div>
                                    <label for="penguji2">Dosen Penguji 2</label>
                                    <input class="form-control" name="penguji2" id="penguji2" type="text"
                                        placeholder="Nama Dosen Penguji 2">
                                </div>
                                <div>
                                    <label for="jumlSKS">Jumlah SKS</label>
                                    <input class="form-control" name="jumSKS" id="jumSKS" type="number"
                                        placeholder="Jumlah SKS Anda...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-2 text-end">
                                <button class="btn btn-lg btn-primary" name="simpan" value="Send" type="submit"
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
