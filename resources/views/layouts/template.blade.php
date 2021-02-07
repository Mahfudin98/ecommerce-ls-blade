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
  {{-- <link rel="stylesheet" href="/css/app.css"> --}}
  @yield('css')
</head>
<body>
        <!--================ Start Header Menu Area =================-->
        @include('layouts.module.header')
        <!--================ End Header Menu Area =================-->

        {{-- main page --}}
        @yield('content')

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

  {{-- <script src="/js/app.js"></script> --}}
  @yield('js')
</body>
</html>
