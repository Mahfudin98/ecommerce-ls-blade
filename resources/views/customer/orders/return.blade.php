@extends('layouts.template')

@section('title')
    {{ $order->invoice }}
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
                <h1>Order Confirmation</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Shop Category</li>
        </ol>
      </nav>
            </div>
        </div>
</div>
</section>
<!-- ================ end banner area ================= -->

<section class="login_box_area section-margin">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <form action="{{ route('customer.return', $order->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="">Alasan Return</label>
                                <textarea name="reason" cols="5" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Refund Transfer</label>
                                <input type="text" name="refund_transfer" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" name="photo" class="form-control" required>
                            </div>
                            <button class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection

@section('js')
@endsection
