@extends('layouts.template')

@section('title')
    Order
@endsection

@section('css')
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
      <div class="blog-banner">
        <div class="text-center">
          <h1>Our Blog</h1>
          <nav aria-label="breadcrumb" class="banner-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Blog</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ end banner area ================= -->


  <!--================Blog Categorie Area =================-->
  <section class="blog_categorie_area">
    <div class="container">
      <div class="row">
            @forelse ($orders as $row)
            <form action="{{ route('customer.order_accept') }}" class="form-inline" onsubmit="return confirm('Kamu Yakin?');" method="post">
                @csrf
                <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="categories_post">
                        <img class="card-img rounded-0" src="{{asset('img/bg-order.jpg')}}" alt="post">
                        <div class="categories_details">
                            <div class="categories_text">
                                <a class="btn btn-success" href="{{ route('customer.view_order', $row->invoice) }}">
                                <input type="hidden" name="order_id" value="{{ $row->id }}">
                                    <h5>{{ $row->invoice }}</h5>
                                </a>
                                <div class="border_line"></div>
                                <p>Rp.{{ number_format($row->total) }}</p>
                                <div class="border_line"></div>

                                @if ($row->status == 3 && $row->return_count == 0)
                                    <button class="btn btn-success">Terima</button>
                                    <a href="{{ route('customer.order_return', $row->invoice) }}" class="btn btn-danger btn-sm mt-1">Return</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @empty

            @endforelse
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->
</main>
@endsection

@section('js')
@endsection
