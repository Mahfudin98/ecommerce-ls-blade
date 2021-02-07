@extends('layouts.template')

@section('title')
    Shop
@endsection

@section('css')
<script type="text/javascript">
    function gotolink() {
        var destination= self.location;

        for(var i = 0; i<document.formname.radiobutton.length; i++){
        if(document.formname.radiobutton[i].checked) {
            destination=document.formname.radiobutton[i].value }
        }
        window.location = destination;
    }
</script>
@endsection

@section('content')
<main class="site-main">
    <!-- ================ start banner area ================= -->
	<section class="blog-banner-area" id="category">
		<div class="container h-100">
			<div class="blog-banner">
				<div class="text-center">
					<h1>Semua Produk</h1>
					<nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Semua Produk</li>
                        </ol>
                    </nav>
				</div>
			</div>
        </div>
	</section>
	<!-- ================ end banner area ================= -->

	<!-- ================ category section start ================= -->
    <section class="section-margin--small mb-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Filter Kategori</div>
                        <ul class="main-categories">
                        <li class="common-filter">
                            <form name="formname">
                                <ul>
                                @foreach ($categories as $category)
                                <li class="filter-list">
                                      <input class="pixel-radio" type="radio" id="men{{ $category->id }}" name="brand" value="http://www.free-backgrounds.com" onClick="gotolink()">
                                      <label for="men{{ $category->id }}">{{ $category->name }}</label>
                                </li>
                                @endforeach
                                </ul>
                            </form>
                        </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap">
                    <div class="sorting">

                    </div>
                    <div class="sorting mr-auto">

                    </div>
                    <div>
                    <div class="input-group filter-bar-search">
                        <input type="text" placeholder="Search">
                        <div class="input-group-append">
                        <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @forelse ($products as $row)
                            <div class="col-md-6 col-lg-4">
                                <div class="card text-center card-product">
                                <div class="card-product__img">
                                    <img class="card-img" src="{{ asset('storage/products/' . $row->image) }}" alt="{{ $row->name }}">
                                    <ul class="card-product__imgOverlay">
                                    <li><button><i class="ti-search"></i></button></li>
                                    <li><button><i class="ti-shopping-cart"></i></button></li>
                                    <li><button><i class="ti-heart"></i></button></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <p>{{ $row->category->name }}</p>
                                    <h4 class="card-product__title"><a href="{{ url('/shop/' . $row->slug) }}">{{ $row->name }}</a></h4>
                                    <p class="card-product__price">Rp.{{ number_format($row->price) }}</p>
                                </div>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                    {{ $products->links('pagination::customer') }}
                </section>
                <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </section>
	<!-- ================ category section end ================= -->

	<!-- ================ Subscribe section start ================= -->
    <section class="subscribe-position">
        <div class="container">
        <div class="subscribe text-center">
            <h3 class="subscribe__title">Get Update From Anywhere</h3>
            <p>Bearing Void gathering light light his eavening unto dont afraid</p>
            <div id="mc_embed_signup">
            <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe-form form-inline mt-5 pt-1">
                <div class="form-group ml-sm-auto">
                <input class="form-control mb-1" type="email" name="EMAIL" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" >
                <div class="info"></div>
                </div>
                <button class="button button-subscribe mr-auto mb-1" type="submit">Subscribe Now</button>
                <div style="position: absolute; left: -5000px;">
                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                </div>

            </form>
            </div>

        </div>
        </div>
    </section>
	<!-- ================ Subscribe section end ================= -->
</main>
@endsection

@section('js')
@endsection
