<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Error 404</title>
    <link rel="stylesheet" href="{{ url('error/style.css') }}">

</head>

<body>
    <!-- partial:index.partial.html -->
    <a href="" target="_blank">
        <header class="top-header">
        </header>

        <!--dust particel-->
        <div>
            <div class="starsec"></div>
            <div class="starthird"></div>
            <div class="starfourth"></div>
            <div class="starfifth"></div>
        </div>
        <!--Dust particle end--->


        <div class="lamp__wrap">
            <div class="lamp">
                <div class="cable"></div>
                <div class="cover"></div>
                <div class="in-cover">
                    <div class="bulb"></div>
                </div>
                <div class="light"></div>
            </div>
        </div>
        <!-- END Lamp -->
        <section class="error">
            <!-- Content -->
            <div class="error__content">

                @yield('content')

                <div class="error__nav e-nav">
                    <a href="{{ route('home') }}" class="e-nav__link"></a>
                </div>
            </div>
            <!-- END Content -->

        </section>

    </a>
    <!-- partial -->

</body>

</html>
