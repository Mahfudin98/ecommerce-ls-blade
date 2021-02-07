@extends('layouts.template')

@section('title')
    Login
@endsection

@section('css')
<link rel="stylesheet" href="{{asset("template/vendors/linericon/style.css")}}">
<link rel="stylesheet" href="{{asset("template/vendors/nouislider/nouislider.min.css")}}">
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Login / Register</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Login/Register</li>
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
            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>New to our website?</h4>
                        <p>There are advances being made in science and technology everyday, and a good example of this is the</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Log in to enter</h3>
                    <form class="row login_form" action="{{ route('customer.post_login') }}" method="POST" id="contactForm">
                        @csrf
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="remember">
                                <label for="f-option2">Keep me logged in</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" class="button button-login w-100">Log In</button>
                            <a href="#">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
</main>
@endsection

@section('js')
<script src="{{asset('template/vendors/skrollr.min.js')}}"></script>
@endsection
