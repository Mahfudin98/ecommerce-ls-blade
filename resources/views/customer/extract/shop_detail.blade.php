@extends('layouts.template')

@section('title')
    Shop Detail
@endsection

@section('css')
<style>
    .rating {
    display: inline-block;
    position: relative;
    height: 50px;
    line-height: 50px;
    font-size: 50px;
    }

    .rating label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    cursor: pointer;
    }

    .rating label:last-child {
    position: static;
    }

    .rating label:nth-child(1) {
    z-index: 5;
    }

    .rating label:nth-child(2) {
    z-index: 4;
    }

    .rating label:nth-child(3) {
    z-index: 3;
    }

    .rating label:nth-child(4) {
    z-index: 2;
    }

    .rating label:nth-child(5) {
    z-index: 1;
    }

    .rating label input {
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    }

    .rating label .icon {
    float: left;
    color: transparent;
    }

    .rating label:last-child .icon {
    color: #000;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
    color: #f27272;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
    color: #000;
    text-shadow: 0 0 5px #f27272;
    }
</style>
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Shop Single</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop Single</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="owl-carousel owl-theme s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3>{{ $product->name }}</h3>
                    <h2>Rp. {{ number_format($product->price) }}</h2><hr>
                    <ul class="list">
                        <li><a class="active" href="#"><span>Category</span> : {{ $product->category->name }}</a></li>
                        @if ($product->stock != null)
                            <li><a href="#"><span>Stock</span> : {{ $product->stock }}</a></li>
                        @else
                            <li><a href="#"><span>Stock</span> : Belum ada stock</a></li>
                        @endif
                    </ul>
                    <hr>
                    <form action="{{ route('guest.cart') }}" method="POST">
                        @csrf
                        <div class="product_count">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<input type="hidden" name="product_id" value="{{ $product->id }}" class="form-control">
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <hr>
                        <button class="button primary-btn" type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                 aria-selected="false">Specification</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                 aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" style="background-color: #ffb19b" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p class="text-justify">{{ $product->description}}</p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Berat</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->weight}} <span>gr</span></h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Stock</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->stock }}</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Harga</h5>
                                </td>
                                <td>
                                    <h5>Rp. {{ number_format($product->price) }}</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="row total_rate">
                            <div class="col-4">
                                <div class="rating_list">

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    <h4>{{ number_format($average, 1) }}</h4>
                                    <h6>({{$comment->count()}} Reviews)</h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="rating_list">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        @forelse ($comment as $row)
                        <div class="review_list">
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        @if ($row->customer->image != null)
                                        <img src="{{ asset('storage/customer/' . $row->customer->image) }}" width="50px" height="50px" class="rounded-circle z-depth-2" alt="">
                                        @else
                                        <img src="{{asset('template/img/avatar3.png')}}" width="50px" class="rounded-circle z-depth-2 img-thumbnail" data-holder-rendered="true" alt="">
                                        @endif

                                    </div>
                                    <div class="media-body">
                                        <h4>{{$row->customer->name}}</h4>
                                        @if ($row->rating == 1)
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        @elseif($row->rating == 2)
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>

                                        @elseif($row->rating == 3)
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>

                                        @elseif($row->rating == 4)
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #000000"></i>

                                        @elseif($row->rating == 5)
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        <i class="fa fa-star" style="color: #f27272"></i>
                                        @endif

                                        <div class="rounded float-right">
                                            @forelse ($image->where('comment_id', $row->id) as $item)
                                            <a href="{{ asset('storage/comment/' . $item->path) }}" target="_blank">
                                                <img class="img-thumbnail" src="{{ asset('storage/comment/' . $item->path) }}" width="50" height="50" alt="">
                                            </a>
                                            @empty

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <p class="text-white align-justify">{{$row->comment}}</p>
                            </div>
                        </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<!--================ Start related Product area =================-->
<section class="related-product-area section-margin--small mt-0">
    <div class="container">
        <div class="section-intro pb-60px">
        <p>Popular Item in the market</p>
        <h2>Top <span class="section-intro__style">Product</span></h2>
    </div>
    <div class="row mt-30">
        @forelse ($list as $row)
            <div class="col-sm-6 col-xl-3 mb-4 mb-xl-0">
                <div class="single-search-product-wrapper">
                    <div class="single-search-product d-flex">
                        <a href="#"><img src="{{ asset('storage/products/' . $row->image) }}" alt="{{ $row->name }}"></a>
                        <div class="desc">
                            <a href="{{ url('/shop/' . $row->slug) }}" class="title">{{ $row->name }}</a>
                            <div class="price">Rp. {{ number_format($product->price) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse
    </div>
</section>
<!--================ end related Product area =================-->
</main>
@endsection

@section('js')
<script>
    $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
    });
</script>
<script src="{{asset('template/vendors/skrollr.min.js')}}"></script>
@endsection
