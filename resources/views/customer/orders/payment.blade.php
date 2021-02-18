@extends('layouts.template')

@section('title')
    Barang Sampai
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
                <h1>Bukti Barang Sampai</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bukti Barang Sampai</li>
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
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
          <p>To track your order please enter your Order ID in the box below and press the "Track" button. This
              was given to you on your receipt and in the confirmation email you should have received.</p>
          <form class="row tracking_form" action="{{route('update.payment', $payment->id)}}" method="post" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="col-md-12 form-group">
                  <input type="file" class="form-control" name="proof" required>
              </div>
              <div class="col-md-12 form-group">
                  <button type="submit" value="submit" class="button button-tracking">Upload Foto</button>
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
