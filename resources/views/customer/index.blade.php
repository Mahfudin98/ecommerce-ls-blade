@extends('layouts.template')

@section('title')
    Home
@endsection

@section('css')
@endsection

@section('content')
<main class="site-main">
    <!--================ Hero banner start =================-->
    <section class="hero-banner">
      <div class="container">
        <div class="row no-gutters align-items-center pt-60px">
          <div class="col-5 d-none d-sm-block">
            <div class="hero-banner__img">
              <img class="img-fluid" src="{{asset('template/img/home/banner.png')}}" alt="">
            </div>
          </div>
          <div class="col-sm-7 col-lg-6 offset-lg-1 pl-4 pl-md-5 pl-lg-0">
            <div class="hero-banner__content">
              <h4>LS SKINCARE</h4>
              <h1>PERFECT YOUR BEAUTY CARE</h1>
              <p>Jelajahi produk premium terbaik kami dengan tampilan terbaru dan nikmati berbagai diskon dan bonus di setiap pembelian 1 paket produk.</p>
              <a class="button button-hero" href="{{route('guest.shop')}}">Jelajahi Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero banner start =================-->

    <!-- ================ trending product section start ================= -->
    <section class="section-margin calc-60px">
      <div class="container">
        <div class="section-intro pb-60px">
          <p>Item Populer di pasar</p>
          <h2>Populer <span class="section-intro__style">Product</span></h2>
        </div>
        <div class="row">
        @forelse ($products as $row)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card text-center card-product">
            <div class="card-product__img">
                <img class="card-img" src="{{ asset('storage/products/' . $row->image) }}" alt="{{ $row->name }}">
                <form action="{{ route('guest.cart') }}" method="POST">
                @csrf
                <ul class="card-product__imgOverlay">
                    <li><a href="{{ url('/shop/' . $row->slug) }}"><button><i class="ti-search"></i></button></a></li>
                    <input type="hidden" name="qty" value="1">
					<input type="hidden" name="product_id" value="{{ $row->id }}">
                    <li><button type="submit"><i class="ti-shopping-cart"></i></button></li>
                </ul>
                </form>
            </div>
            <div class="card-body">
                <p>{{ $row->category->name }}</p>
                <h4 class="card-product__title"><a href="{{ url('/shop/' . $row->slug) }}">{{ $row->name }}</a></h4>
                <p class="card-product__price">Rp.{{ number_format($row->price) }}</p>
            </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <h3 class="text-center">Tidak ada produk</h3>
        </div>
        @endforelse
        </div>
      </div>
    </section>
    <!-- ================ trending product section end ================= -->


    <!-- ================ offer section start ================= -->
    {{-- <section class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
      <div class="container">
        <div class="row">
          <div class="col-xl-5">
            <div class="offer__content text-center">
              <h3>Sale 30%</h3>
              <h4>Harga PROMO</h4>
              <p>Hanya Rp.180.000</p>
              <a class="button button--active mt-3 mt-xl-4" href="{{route('guest.shop')}}">Shop Now</a>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- ================ offer section end ================= -->

    <!-- ================ Best Selling item  carousel ================= -->
    <section class="section-margin calc-60px">

    </section>
    <!-- ================ Best Selling item  carousel end ================= -->

    <!-- ================ Blog section start ================= -->
    <section class="blog">
      <div class="container">
        <div class="section-intro pb-60px">
          <h2>Berita <span class="section-intro__style">LS Skincare</span></h2>
        </div>

        <div class="row">
          @foreach ($news->chunk(3) as $item)
            @forelse ($item as $row)
            <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                <div class="card card-blog">
                <div class="card-blog__img">
                    <img class="card-img rounded-0" src="{{ asset('storage/news/' . $row->image) }}" alt="{{ $row->title }}">
                </div>
                <div class="card-body">
                    <ul class="card-blog__info">
                    <li><a href="#">Sumber : {{ $row->sumber }}</a></li>
                    </ul>
                    <h4 class="card-blog__title"><a href="{{ $row->link }}" target="_blank" rel="{{ $row->title }}">{{ $row->title }}</a></h4>
                    <p>{{ $row->body }}</p>
                    <a class="card-blog__link" href="{{ $row->link }}" target="_blank" rel="{{ $row->title }}">Read More <i class="ti-arrow-right"></i></a>
                </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <h3 class="text-center">Tidak ada berita</h3>
            </div>
            @endforelse
          @endforeach
        </div>
      </div>
    </section>

    <!-- ================ Blog section end ================= -->

    <!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
      <div class="container">
          <div class="offer" id="parallax-1" data-anchor-target="#parallax-1" data-300-top="background-position: 20px 30px" data-top-bottom="background-position: 0 20px">
            <div class="subscribe text-center">
                <h3 class="subscribe__title">Produk Skincare Yang Terpercaya</h3>
                <p>Lihat berita tentang LS SKINCARE lebih banyak</p>
                <div id="mc_embed_signup">
                    <a class="button button-subscribe mr-auto mb-1" href="{{ route('ls.news') }}">Lihat Selengkapnya</a>
                </div>
            </div>
          </div>
      </div>
    </section>
    <!-- ================ Subscribe section end ================= -->
</main>
@endsection

@section('js')
@endsection
