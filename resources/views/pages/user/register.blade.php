@extends('layouts.user')

@section('title')
    <title>SI ATI | Daftar</title>
@endsection

@section('content')
<section class="pt-5 pb-6 h-100" id="home">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center">
            <h3 class="text-center">Daftar</h3>
            <p class="text-center">Registrasi Akun</p>
            <div class="col-lg-10">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group row justify-content-center align-items-center mt-4">
                                <div class="col-2">
                                    <label for="npm">NPM</label>
                                </div>
                                <div class="col-8 text-center">
                                    <input type="text" name="npm" id="npm" class="form-control @error('npm') is-invalid @enderror" placeholder="NPM">
                                    @error('npm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center align-items-center mt-3">
                                <div class="col-2">
                                    <label for="nama">Nama</label>
                                </div>
                                <div class="col-8 text-center">
                                    <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama">
                                    @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center align-items-center mt-3">
                                <div class="col-2">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-8 text-center">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center align-items-center mt-3">
                                <div class="col-2">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-8 text-center">
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Password">
                                        @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row justify-content-center align-items-center mt-3">
                                <div class="col-2">
                                    <label for="password_confirmation">Konfirmasi Password</label>
                                </div>
                                <div class="col-8 text-center">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Konfirmasi Password">
                                        @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button type="reset" class="btn btn-info mx-3">Reset</button>
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
