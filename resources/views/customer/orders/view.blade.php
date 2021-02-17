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
                <h1>Order</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order</li>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Data Pelanggan</h4>
                            </div>
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="30%">InvoiceID</td>
                                        <td width="5%">:</td>
                                        <th><a href="{{ route('customer.order_pdf', $order->invoice) }}" target="_blank"><strong>{{ $order->invoice }}</strong></a></th>
                                    </tr>
                                    <tr>
                                        <td>Nama Lengkap</td>
                                        <td width="5%">:</td>
                                        <th>{{ $order->customer_name }}</th>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <th>{{ $order->customer_phone }}</th>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <th>{{ $order->customer_address }}, {{ $order->district->name }} {{ $order->district->city->name }}, {{ $order->district->city->province->name }}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    Pembayaran

                                    @if ($order->status == 0)
                                    <a href="{{ url('member/payment?invoice=' . $order->invoice) }}" class="btn btn-primary btn-sm float-right">Konfirmasi</a>
                                    @endif
                                </h4>
                            </div>
                            <div class="card-body">
                                @if ($order->payment)
                                <table>
                                    <tr>
                                        <td width="30%">Nama Pengirim</td>
                                        <td width="5%"></td>
                                        <td>{{ $order->payment->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Transfer</td>
                                        <td></td>
                                        <td>{{ $order->payment->transfer_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Transfer</td>
                                        <td></td>
                                        <td>Rp {{ number_format($order->payment->amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tujuan Transfer</td>
                                        <td></td>
                                        <td>{{ $order->payment->transfer_to }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bukti Transfer</td>
                                        <td></td>
                                        <td>
                                            <img src="{{ asset('storage/payment/' . $order->payment->proof) }}" width="50px" height="50px" alt="">
                                            <a href="{{ asset('storage/payment/' . $order->payment->proof) }}" target="_blank">Lihat Detail</a>
                                        </td>
                                    </tr>
                                </table>
                                @else
                                <h4 class="text-center">Belum ada data pembayaran</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Quantity</th>
                                                <th>Berat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($order->details as $row)
                                            <tr>
                                                <td>{{ $row->product->name }}</td>
                                                <td>{{ number_format($row->price) }}</td>
                                                <td>{{ $row->qty }} Item</td>
                                                <td>{{ $row->weight }} gr</td>
                                                <td>
                                                    <a href="{{ url('/member/comment/' . $row->product->slug) }}">
                                                        <button class="btn btn-warning"><i class="fas fa-star" style="color: #f27272">
                                                            </i>Nilai disini!
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
