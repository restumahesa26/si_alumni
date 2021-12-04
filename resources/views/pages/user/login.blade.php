@extends('layouts.user')

@section('title')
    <title>SI ATI | Masuk</title>
@endsection

@section('content')
<section class="pt-4 pb-0" id="home">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <h3 class="text-center pt-5 mb-4 ">Selamat Datang</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body text-center">
                            <h3 class="mb-3">Masuk</h3>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-2 text-center">
                                    <i class="fas fa-user-alt" style="font-size: 30px; color: #002147"></i>
                                </div>
                                <div class="col-md-8 mt-1 text-center">
                                    <input type="text" name="login" id="login" class="form-control @error('login')
                                    is-invalid
                                @enderror" placeholder="NPM">
                                </div>
                            </div>
                            <div class="form-group row mt-3 justify-content-center">
                                <div class="col-md-2 text-center">
                                    <i class="fas fa-lock" style="font-size: 30px; color: #002147"></i>
                                </div>
                                <div class="col-md-8 text-center">
                                    <input type="password" name="password" id="password" class="form-control @error('password')
                                        is-invalid
                                    @enderror" placeholder="Password">
                                </div>
                            </div>
                            <input type="checkbox" name="remember" id="remember" value="Remember Me" class="mt-3">
                            <label for="remember">Remember Me</label>
                            <div class="text-center">
                                <button type="submit" class="btn btn-secondary mt-2">Masuk</button>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{ route('register') }}" class="text-primary">Belum punya akun? Daftar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
