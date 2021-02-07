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

<!--================Order Details Area =================-->
<section class="order_details section-margin--small">
<div class="container">
  <p class="text-center billing-alert">Terima kasih atas pesananya. silahkan cek email kamu untuk login!</p>
  <div class="row mb-5">
    <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
      <div class="confirmation-card">
        <h3 class="billing-title">Order Info</h3>
        <table class="order-rable">
          <tr>
            <td>Invoice</td>
            <td>: {{ $order->invoice }}</td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>: {{date('M d, Y', strtotime($order->created_at))}}</td>
          </tr>
          <tr>
            <td>Subtotal</td>
            <td>: Rp {{ number_format($order->subtotal) }}</td>
          </tr>
          <tr>
            <td>Ongkos Kirim</td>
            <td>: Rp {{ number_format($order->cost) }}</td>
          </tr>
          <tr>
            <td>Total</td>
            <td>: Rp {{ number_format($order->total) }}</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
      <div class="confirmation-card">
        <h3 class="billing-title">Informasi Pemesan</h3>
        <table class="order-rable">
          <tr>
            <td>Alamat</td>
            <td>: {{ $order->customer_address }}</td>
          </tr>
          <tr>
            <td>Kota</td>
            <td>: {{ $order->district->city->name }}</td>
          </tr>
          <tr>
            <td>Negara</td>
            <td>: Indonesia</td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
      <div class="confirmation-card">
        <h3 class="billing-title">Informasi Pengirim</h3>
        <table class="order-rable">
          <tr>
            <td>Alamat</td>
            <td>: Blok Mekar Mulia, Rt/Rw 01/1, Ds. Tenjolayar, Kec. Cigasong</td>
          </tr>
          <tr>
            <td>Kota</td>
            <td>: Kabupaten Majalengka</td>
          </tr>
          <tr>
            <td>Negara</td>
            <td>: Indonesia</td>
          </tr>
          <tr>
            <td>Postcode</td>
            <td>: 45476</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="order_details_table">
    <h2>Order Details</h2>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <p>{{ substr($orderdetail->product->name, 0, 20). ' ....'}}</p>
            </td>
            <td>
              <h5>x {{ $orderdetail->qty }}</h5>
            </td>
            <td>
              <p>Rp.{{ number_format($orderdetail->price * $orderdetail->qty) }}</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Subtotal</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <p>Rp.{{ number_format($orderdetail->price * $orderdetail->qty) }}</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Ongkir</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <p>Rp {{ number_format($order->cost) }}</p>
            </td>
          </tr>
          <tr>
            <td>
              <h4>Total</h4>
            </td>
            <td>
              <h5></h5>
            </td>
            <td>
              <h4>Rp {{ number_format($order->total) }}</h4>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</section>
<!--================End Order Details Area =================-->
</main>
@endsection

@section('js')
@endsection
