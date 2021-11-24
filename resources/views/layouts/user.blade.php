<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>SI ATI | Beranda</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/public/assets/img/favicons/favicon.ico') }}" />
    <link rel="manifest" href="{{ url('frontend/public/assets/img/favicons/manifest.json') }}" />
    <meta name="msapplication-TileImage" content="{{ url('frontend/public/assets/img/favicons/mstile-150x150.png') }}" />
    <meta name="theme-color" content="#ffffff" />

    @include('includes.user.style')
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        @include('includes.user.navbar')

        @yield('content')

        @include('includes.user.footer')

    </main>

    @include('includes.user.script')

</body>

@stack('addon-script')

</html>
