@extends('layouts.template')

@section('title')
    Verify
@endsection

@section('css')
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Verifikasi Akun</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Akun</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->


<!--================Tracking Box Area =================-->
<section class="tracking_box_area section-margin--small">
  <div class="container">
      <div class="tracking_box_inner">
          <p>Silahkan Masukan Kode Verifikasi</p>
          <form class="row tracking_form" action="{{route('post.verify')}}" method="post" novalidate="novalidate">
              @csrf
              <div class="col-md-12 form-group">
                  <input type="text" class="form-control" id="active_token" name="active_token" placeholder="Verifikasi Kode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Verifikasi Kode'">
              </div>
              <div class="col-md-12 form-group">
                  <button type="submit" value="submit" class="button button-tracking">Submit</button>
              </div>
          </form>
      </div>
  </div>
</section>
<!--================End Tracking Box Area =================-->
</main>
@endsection

@section('js')
@endsection
