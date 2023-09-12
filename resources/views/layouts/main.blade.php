<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Summernote CSS - CDN Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->

    {{-- Google Analityc --}}
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-NYQDKNF92Z"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-NYQDKNF92Z');
    </script>
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-263169045-1" id="google_gtagjs-js" async type="719a15583f94f26009c4e225-text/javascript"></script>
    <script id="google_gtagjs-js-after" type="719a15583f94f26009c4e225-text/javascript">
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('set', 'linker', {"domains":["radarbekasi.id"]} );
    gtag("js", new Date());
    gtag("set", "developer_id.dZTNiMT", true);
    gtag("config", "UA-263169045-1", {"anonymize_ip":true});
    gtag("config", "GT-M6PJLW3");
    </script> --}}

    {{-- Fancy Box --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css">

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sorts+Mill+Goudy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    @livewireStyles

    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    {{-- Aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/img/icon bekasi.png') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <title>Polling Radar Bekasi | {{ $title }}</title>
  </head>
  <body class="bg-light">

    {{-- @if (Auth::guard('admin')->user())
    @include('layouts.navbar')
    @else
    @include('layouts.navHome')
    @endif --}}

    @include('layouts.navbar')

    {{-- <div class="container"> --}}
    {{-- Content --}}
        @yield('child')
    {{-- </div> --}}

    @include('layouts.footer')

    <!-- JQuery summernote-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>




    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>




    {{-- Fancy Box --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    {{-- Light Box --}}
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.0/dist/index.bundle.min.js"></script>

    <!-- Slick JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!-- Summernote JS - CDN Link -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- //Summernote JS - CDN Link -->

    {{-- Aos --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        </script>
    @livewireScripts
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>

  </body>
</html>
