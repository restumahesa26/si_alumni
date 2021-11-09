<!--**********************************
            Sidebar start
        ***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">{{ Auth::user()->role }}</li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="ti-user"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-label">MENU</li>
            @if (Auth::user()->role === 'ALUMNI' || Auth::user()->role === 'MAHASISWA')
            <li class="@if(Route::is('profile.*'))mm-active @endif">
                <a href="{{ route('profile.edit') }}" class="@if(Route::is('profile.*'))mm-active @endif">
                    <i class="ti-user"></i><span class="nav-text">Profile</span>
                </a>
            </li>
            @endif
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="ti-agenda"></i><span class="nav-text">Data</span></a>
                <ul aria-expanded="false">
                    <li class="@if(Route::is('data-mahasiswa.*'))mm-active @endif">
                        <a href="{{ route('data-mahasiswa.index') }}" class="@if(Route::is('data-mahasiswa.*'))mm-active @endif">
                            Data Mahasiswa
                        </a>
                    </li>
                    <li class="@if(Route::is('data-alumni.*'))mm-active @endif" >
                        <a href="{{ route('data-alumni.index') }}" class="@if(Route::is('data-alumni.*'))mm-active @endif">
                            Data Alumni
                        </a>
                    </li>
                    <li class="@if(Route::is('data-admin.*'))mm-active @endif">
                        <a href="{{ route('data-admin.index') }}" class="@if(Route::is('data-admin.*'))mm-active @endif">
                            Data Admin
                        </a>
                    </li>
                </ul>
            </li>
            <li class="@if(Route::is('loker.*'))mm-active @endif">
                <a href="{{ route('loker.index') }}" class="@if(Route::is('loker.*'))mm-active @endif">
                    <i class="ti-id-badge"></i><span class="nav-text">Lowongan Kerja</span>
                </a>
            </li>
            <li class="@if(Route::is('diskusi.*'))mm-active @endif">
                <a href="{{ route('diskusi.index') }}" class="@if(Route::is('diskusi.*'))mm-active @endif">
                    <i class="ti-email"></i><span class="nav-text">Diskusi</span>
                </a>
            </li>
            <li class="@if(Route::is('berita.*'))mm-active @endif">
                <a href="{{ route('berita.index') }}" class="@if(Route::is('berita.*'))mm-active @endif">
                    <i class="ti-image"></i><span class="nav-text">Berita</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->
