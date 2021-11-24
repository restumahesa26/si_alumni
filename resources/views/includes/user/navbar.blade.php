<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="bg-primary py-2 d-none d-sm-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-auto d-none d-lg-block">
                <p class="my-2 fs--1">
                    <i class="fas fa-map-marker-alt me-3"></i><span>Jl. W.R. Supratman Kandang Limun Bengkulu
                        38371 A Sumatera -
                        INDONESIA
                    </span>
                </p>
            </div>
            <div class="col-auto">
                <p class="my-2 fs--1">
                    <i class="fas fa-envelope me-3"></i><a class="text-900"
                        href="mailto:vctung@outlook.com">informatika@unib.ac.id
                    </a>
                </p>
            </div>
        </div>
    </div>
    <!-- end of .container-->
</section>
<!-- <section> close ============================-->
<!-- ============================================-->
<nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ url('frontend/public/assets/img/gallery/logo-n.png') }}" alt="" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
                <li class="nav-item px-2">
                    <a class="nav-link @if(Route::is('home')) border-bottom border-3 border-primary @endif" aria-current="page"
                        href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link @if(Route::is('daftar-alumni')) border-bottom border-3 border-primary @endif" aria-current="page" href="{{ route('daftar-alumni') }}">Daftar Alumni</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link @if(Route::is('user.berita') || Route::is('user.detail-berita')) border-bottom border-3 border-primary @endif" aria-current="page" href="{{ route('user.berita') }}">Berita</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link @if(Route::is('user.loker') || Route::is('user.detail-loker')) border-bottom border-3 border-primary @endif" aria-current="page" href="{{ route('user.loker') }}">Info Loker</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link @if(Route::is('user.diskusi') || Route::is('user.detail-diskusi')) border-bottom border-3 border-primary @endif" aria-current="page" href="{{ route('user.diskusi') }}">Diskusi</a>
                </li>
                @if (Auth::user())
                <div class="nav-item px-2 btn-group">
                    <a class="d-flex align-items-center" href="">
                        <img class="img-profile rounded-circle border-secondary" alt="image"
                            src="{{ url('frontend/public/assets/img/favicons/logo-bulat1.png') }}" height="30" />
                    </a>
                    <a role="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" id="userDropdown" style="text-transform: capitalize !important;">
                        {{ Auth::user()->role }}
                    </a>
                    <ul class="
                    dropdown-menu dropdown-menu-end
                    shadow
                    animated--grow-in
                    bg-white
                  " aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="data-saya.html"><i
                                class="fas fa-database fa-sm fa-fw text-gray-400"></i>
                            Data Saya</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
                            Log Out
                            </a>
                        </form>
                    </ul>
                </div>
                @else
                <li class="nav-item px-2">
                    <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" aria-current="page" href="{{ route('register') }}">Register</a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
