<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    {{--    Meta--}}
    <meta name="title" content="@yield('title')">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    {{--    OG META  --}}
    <meta property="og:url" content="@yield('url')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('ogImage')">
    <meta property="og:image:alt" content="@yield('ogImageAlt')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="The Clock Time" />
    {{--    End OG--}}
    <meta name="msvalidate.01" content="@yield('msvalidate')" />
    <meta name="google-site-verification" content="@yield('google-site-verification')" />

    <link rel="shortcut icon" type="image/x-icon" href="#"> {{-- this link need image --}}
    <link rel="stylesheet" href="{{ asset('cdn/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Home.css') }}" />
    <!-- Include Moment.js and Moment Timezone -->
    <script src="{{ asset('cdn/moment.min.js') }}"></script>
    <script src="{{ asset('cdn/moment-timezone-with-data.min.js') }}"></script>
    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="{{ asset('cdn/leaflet.css') }}">
    <!-- Include jQuery (required for Select2) -->
    <script src="{{ asset('cdn/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('cdn/css2.css') }}">
    <script src="{{ asset('tagify/tagify.js') }}"></script>
    <script src="{{ asset('tagify/tagify.polyfills.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('tagify/tagify.css') }}">
    <!-- Google tag (gtag.js) -->
    <script src="{{ asset('cdn/js.js') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-WG483ZXMQH');
    </script>
    <style>
        /* Set the size of the map */
        #map {
            height: 400px;
            /* Set the height of the map */
            width: 100%;
            /* Set the width of the map */
        }
    </style>
    <style>
        .clock {
            width: 150px;
            height: 150px;
            border: 8px solid white;
            border-radius: 50%;
            position: relative;
            margin: 50px auto;
        }

        .clock .hour,
        .clock .minute,
        .clock .second {
            position: absolute;
            width: 50%;
            height: 6px;
            background: White;
            top: 50%;
            transform-origin: 100%;
            transform: rotate(90deg);
            transition-timing-function: ease-in;
        }

        .clock .minute {
            background: gray;
            height: 4px;
        }

        .clock .second {
            background: red;
            height: 2px;
        }

        .clock .center {
            width: 20px;
            height: 20px;
            background: white;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    @yield('style')
</head>
