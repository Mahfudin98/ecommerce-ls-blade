<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PT LAROSSA | @yield('title')</title>
  <link rel="icon" href="img/icon.png" type="image/png">
  <link rel="stylesheet" href="{{asset('template/vendors/bootstrap/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/nice-select/nice-select.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/owl-carousel/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/owl-carousel/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/nouislider/nouislider.min.css')}}">

  <link rel="stylesheet" href="{{asset('template/vendors/fontawesome/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/linericon/style.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/themify-icons/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/costum.css')}}">
  <style>
    .myBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        font-size: 18px;
        border: none;
        outline: none;
        background-color: white;
        color: #f27272;
        cursor: pointer;
        padding: 15px;
        width: 70px;
        height: 70px;
        border-radius: 100%;
    }

    .myBtn:hover {
        background-color: #f27272;
        color: white;
    }

  </style>
  {{-- <link rel="stylesheet" href="/css/app.css"> --}}
  @yield('css')
</head>
<body>
        <!--================ Start Header Menu Area =================-->
        @include('layouts.module.header')
        <!--================ End Header Menu Area =================-->

        {{-- main page --}}
        @yield('content')
        @if (is_object($cs) && $cs->count())
        <a href="https://wa.me/{{$cs->phone}}?text={{$cs->message}}">
            <button id="myBtn" class="myBtn"><i class="fa fa-whatsapp" style="font-size:40px;"></i></button>
        </a>
        @endif
        <!--================ Start footer Area  =================-->
        @include('layouts.module.footer')
        <!--================ End footer Area  =================-->
        <script src="{{asset('template/vendors/jquery/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('template/vendors/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('template/vendors/owl-carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('template/vendors/nice-select/jquery.nice-select.min.js')}}"></script>
        {{-- <script src="{{asset('template/vendors/jquery.form.js')}}"></script> --}}
        {{-- <script src="{{asset('template/vendors/jquery.validate.min.js')}}"></script> --}}
        <script src="{{asset('template/vendors/contact.js')}}"></script>
        <script src="{{asset('template/vendors/nouislider/nouislider.min.js')}}"></script>
        <script src="{{asset('template/vendors/jquery.ajaxchimp.min.js')}}"></script>
        <script src="{{asset('template/vendors/mail-script.js')}}"></script>
        <script src="{{asset('template/js/main.js')}}"></script>

        <script src="https://kit.fontawesome.com/395b063175.js" crossorigin="anonymous"></script>
        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite -
            //   see more here
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');

        </script>

          {{-- flying button --}}
          <script>
            //Get the button
            var mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            mybutton.style.display = "block";
        </script>
          <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        {{-- <script src="/js/app.js"></script> --}}
        @yield('js')
</body>
</html>
