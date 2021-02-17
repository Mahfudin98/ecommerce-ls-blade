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
        @foreach ($orders->chunk(3) as $item)
            <div class="row">
                @forelse ($item as $row)
                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                        <div class="categories_post">
                            <img class="card-img rounded-0" src="{{asset('img/bg-order.jpg')}}" alt="{{$row->invoice}}">
                            <div class="categories_details">
                                <div class="categories_text">
                                    <a class="btn btn-success" href="{{ route('customer.view_order', $row->invoice) }}">

                                        <h5>{{ $row->invoice }}</h5>
                                    </a>
                                    <div class="border_line"></div>
                                    <p>Rp.{{ number_format($row->total) }}</p>
                                    <div class="border_line"></div>
                                    @if ($row->status == 4 && $row->return_count == 0)
                                        <span style="color: palegreen">Selesai</span>
                                    @endif
                                    @if ($row->status == 4 && $row->return_count == 1)
                                        <span style="color: red">Return Selesai</span>
                                    @endif

                                    <form action="{{ route('customer.order_accept') }}" class="form-inline" onsubmit="return confirm('Kamu Yakin?');" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $row->id }}">
                                    @if ($row->status == 3 && $row->return_count == 0)
                                        <button class="btn btn-success">Terima</button>
                                        <a href="{{ route('customer.order_return', $row->invoice) }}" class="btn btn-danger btn-sm mt-1">Return</a>
                                    @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        @endforeach
    </div>
</section>
<!--================Blog Categorie Area =================-->
</main>
@endsection

@section('js')
@endsection
