@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('template/css/custom.css')}}">
@endsection

@section('content')
<main class="site-main">

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Dashboard</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

<section class="cart_area">
    <div class="content">
        <div class="container">
          <div class="row">

          <!-- Icon Cards-->
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide bg-pics">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                        <img src="{{asset('svg/payment.svg')}}">
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Belum Dibayar</h4>
                        <h2>Rp {{ number_format($orders[0]->pending) }}</h2>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide bg-pics">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                        <img src="{{asset('svg/truck.svg')}}">
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Dikirim</h4>
                        <h2>{{ $orders[0]->shipping }} Pesanan</h2>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                <div class="inforide bg-pics">
                  <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                        <img src="{{asset('svg/paket.svg')}}">
                    </div>
                    <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                        <h4>Selesai</h4>
                        <h2>{{ $orders[0]->completeOrder }} Pesanan</h2>
                    </div>
                  </div>
                </div>
            </div>

        </div>
      </div>
    </div>
</section>
</main>
@endsection

@section('js')
@endsection
