@extends('layouts.template')

@section('title')
    Ratting
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
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Penilaian Customer</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian Customer</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" style="background-color: #ffb19d80">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <form action="{{route('comment.post')}}" method="POST" class="form-contact form-review mt-3" enctype="multipart/form-data">
                        @csrf
                            <h4>Add a Review</h4>
                            <h6>Your Rating:</h6>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="customer_id" value="{{ auth()->guard('customer')->user()->id }}">
                            <div class="rating">
                                <label>
                                    <input type="radio" name="rate" value="1" />
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="rate" value="2" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="rate" value="3" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="rate" value="4" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                                <label>
                                    <input type="radio" name="rate" value="5" />
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                    <span class="icon">★</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control different-control w-100" name="comment" id="textarea" cols="30" rows="5" placeholder="Enter Message"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="text-dark">Maksimal 5 gambar | Kosongkan jika tidak perlu</label>
                                <input id="image" type="file" class="form-control different-control w-100" max="5" name="image[]" multiple="true">
                            </div>
                            <div class="form-group text-center text-md-right mt-3">
                                <button type="submit" class="button">Submit Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
</main>
@endsection

@section('js')
<script>
    $(':radio').change(function() {
    console.log('New star rating: ' + this.value);
    });
</script>
@endsection
