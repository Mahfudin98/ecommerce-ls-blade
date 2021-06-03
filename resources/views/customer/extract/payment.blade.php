@extends('layouts.template')

@section('title')
    Dashboard
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('template/css/custom.css')}}">
@endsection

@section('content')
<main class="site-main">
<section class="login_box_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="login_form_inner register_form_inner">
                    <h3>Konfirmasi Pembayaran</h3>
                    <form class="row login_form" action="{{ route('customer.savePayment') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="col-md-12 form-group">
                            <input type="text" name="invoice" class="form-control" value="{{ request()->invoice }}" placeholder="Invoice ID" required>
                            <p class="text-danger">{{ $errors->first('invoice') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nama Pengirim" required>
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <select name="transfer_to" class="form-control" required>
                                <option value="">Transfer Ke - Pilih</option>
                                <option value="MANDIRI - 1340022012222">MANDIRI: 1340022012222 a.n Aceng Sunanto</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('transfer_to') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="number" name="amount" class="form-control" placeholder="Jumlah Transfer" required>
                            <p class="text-danger">{{ $errors->first('amount') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="date" name="transfer_date" id="transfer_date" class="form-control" placeholder="Tanggal Transfer" required>
                            <p class="text-danger">{{ $errors->first('transfer_date') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="">Bukti Transfer</label>
                            <input type="file" name="proof" class="form-control" required>
                            <p class="text-danger">{{ $errors->first('proof') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <button class="btn btn-primary btn-sm">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection

@section('js')
@endsection
