@extends('layouts.template')

@section('title')
    Contact
@endsection

@section('css')
<style>
.map-responsive{
    overflow:hidden;
    padding-bottom:0;
    position:relative;
    height:0;
}
.map-responsive iframe{
    left:0;
    top:0;
    height:420px;
    width:100%;
    position:absolute;
}
</style>
@endsection

@section('content')
<main class="site-main">
<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="contact">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Hubungi Kami</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hubungi Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

<!-- ================ contact section start ================= -->
<section class="section-margin--small">
<div class="container">
  <div class="d-none d-sm-block mb-5 pb-4">
    <div class="map-responsive" style="height: 420px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1665.5982588309703!2d108.2678117471461!3d-6.83259316854083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNDknNTUuMCJTIDEwOMKwMTYnMDYuMiJF!5e0!3m2!1sid!2sid!4v1613702529360!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-home"></i></span>
        <div class="media-body">
          <h3>Tenjolayar, Cigasong</h3>
          <p>Majalengka, Jawa Barat</p>
        </div>
      </div>
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-mobile"></i></span>
        <div class="media-body">
          <h3><a href="tel:085289654321">085289654321</a></h3>
          <p>Senin - Sabtu, 08.00 s/d 16.00</p>
        </div>
      </div>
      <div class="media contact-info">
        <span class="contact-info__icon"><i class="ti-email"></i></span>
        <div class="media-body">
          <h3><a href="mailto:lsastarisukses@gmail.com">lsastarisukses@gmail.com</a></h3>
          <p>Kirimkan pertanyaan kapanpun!</p>
        </div>
      </div>
    </div>
    <div class="col-md-8 col-lg-9">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
      <form action="{{route('post.contact')}}" class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
        @csrf
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
            </div>
            <div class="form-group">
              <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
            </div>
            <div class="form-group">
              <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="form-group">
                <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message"></textarea>
            </div>
          </div>
        </div>
        <div class="form-group text-center text-md-right mt-3">
          <button type="submit" class="button button--active button-contactForm">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
</section>
<!-- ================ contact section end ================= -->
</main>
@endsection

@section('js')
@endsection
