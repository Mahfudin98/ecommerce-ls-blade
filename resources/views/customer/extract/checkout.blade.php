@extends('layouts.template')

@section('title')
    Checkout
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
                <h1>Product Checkout</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol>
      </nav>
            </div>
        </div>
</div>
</section>
<!-- ================ end banner area ================= -->


<!--================Checkout Area =================-->
<section class="checkout_area section-margin--small">
<div class="container">
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if (auth()->guard('customer')->check())

    @else
    <div class="returning_customer">
        <div class="check_title">
            <h2>Pelanggan yang kembali? <a href="{{ route('customer.login') }}">Klik di sini untuk login</a></h2>
        </div>
        <p>Jika Anda pernah berbelanja dengan kami sebelumnya, silahkan login pada form yang ada dibawah. Jika Anda baru
            pelanggan, lanjutkan ke bagian Penagihan & Pengiriman.</p>
        <form class="row contact_form" action="{{ route('customer.post_login') }}" method="POST" id="contactForm">
                @csrf
            <div class="col-md-12 form-group p_star">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
            </div>
            <div class="col-md-12 form-group p_star">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <div class="col-md-12 form-group">
                <button type="submit" value="submit" class="button button-login">login</button>
                <div class="creat_account">
                    <input type="checkbox" id="f-option" name="selector">
                    <label for="f-option">Remember me</label>
                </div>
                <a class="lost_pass" href="#">Lost your password?</a>
            </div>
        </form>
    </div>
    @endif
    {{-- start billing detail --}}
    <div class="billing_details">
        <div class="row">
            <div class="col-lg-8">
                <h3>Rincian Penagihan</h3>
                <form class="row contact_form" action="{{ route('guest.store_checkout') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="col-md-6 form-group p_star">
                        @if (auth()->guard('customer')->check())
                        <input type="text" class="form-control" id="first" name="customer_name"
                        value="{{ auth()->guard('customer')->user()->name }}" required>
                        @else
                            <input type="text" class="form-control" id="first" name="customer_name" placeholder="Nama Lengkap" required>
                        @endif
                        <p class="text-danger">{{ $errors->first('customer_name') }}</p>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        @if (auth()->guard('customer')->check())
                        <input type="text" class="form-control" id="number" name="customer_phone"
                        value="{{ auth()->guard('customer')->user()->phone_number }}" required>
                        @else
                            <input type="text" class="form-control" id="number" name="customer_phone" placeholder="Nomor Telepon" required>
                        @endif
                        <p class="text-danger">{{ $errors->first('customer_phone') }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        @if (auth()->guard('customer')->check())
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->guard('customer')->user()->email }}"
                                required {{ auth()->guard('customer')->check() ? 'readonly':'' }}>
                        @else
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        @endif
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </div>
                    <div class="col-md-12 form-group p_star">
                        @if (auth()->guard('customer')->check())
                        <input type="text" class="form-control" id="add1" name="customer_address"
                        value="{{ auth()->guard('customer')->user()->address }}" required>
                        @else
                            <input type="text" class="form-control" id="add1" name="customer_address" placeholder="Alamat Lengkap" required>
                        @endif
                        <p class="text-danger">{{ $errors->first('customer_address') }}</p>
                    </div>
                    <div class="col-md-12 form-group p_star">
                        <select class="form-control" name="province_id" id="province_id" required>
                            <option value="">Pilih Propinsi</option>
                            @foreach ($provinces as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{ $errors->first('province_id') }}</p>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <select class="form-control" name="city_id" id="city_id" required>
                            <option value="">Pilih Kabupaten/Kota</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('city_id') }}</p>
                    </div>
                    <div class="col-md-6 form-group p_star">
                        <select class="form-control" name="district_id" id="district_id" required>
                            <option value="">Pilih Kecamatan</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('district_id') }}</p>
                    </div>
                    <div class="col-md-12 form-group p_star">
                        <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                        <select class="form-control" name="courier" id="courier" required>
                            <option value="">Pilih Kurir</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('courier') }}</p>
                    </div>
                    <div class="col-md-12 form-group p_star">
                        <select class="form-control" name="metode" id="metode" required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="cod">COD (Cash On Delivery)</option>
                            <option value="trasfer">Transfer</option>
                        </select>
                        <p class="text-danger">{{ $errors->first('metode') }}</p>
                    </div>
                    <div class="col-md-12 form-group p_star">
                        <input type="hidden" name="ongkos" id="ongkos">
                        {{-- <input type="text" name="weight" id="estimasi"> --}}
                        <p class="text-danger">{{ $errors->first('courier') }}</p>
                    </div>
                    <div class="col-md-12 form-group">
                        <div class="creat_account">
                            <button class="button button-paypal" href="#">Proses Pembayaran</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="order_box">
                    <h2>Pesanan Anda</h2>
                    <ul class="list">
                        <li><a href="#"><h4>Produk <span>Total</span></h4></a></li>
                        @foreach ($carts as $row)
                        <li>
                            <a href="#">
                                {{ substr($row['product_name'], 0, 12). '...' }}
                                <span class="middle">x {{ $row['qty'] }}</span>
                                <span class="last">Rp.{{ number_format($row['product_price'] * $row['qty']) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="list list_2">
                        <li><a href="#">Subtotal <span>Rp.{{ number_format($subtotal) }}</span></a></li>
                        <li><a href="#">Ongkir <span id="ongkir">Rp.0</span></a></li>
                        <li><a href="#">Total <span id="total">Rp.0</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!--================End Checkout Area =================-->
</main>
@endsection

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    $('#province_id').on('change', function() {
        $.ajax({
            url: "{{ url('/api/city') }}",
            type: "GET",
            data: { province_id: $(this).val() },
            success: function(html){

                $('#city_id').empty()
                $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                $.each(html.data, function(key, item) {
                    $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                })
            }
        });
    })
    $('#city_id').on('change', function() {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: { city_id: $(this).val() },
            success: function(html){
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function(key, item) {
                    $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                })
            }
        });
    })
    $('#district_id').on('change', function() {
        $('#courier').empty()
        $('#courier').append('<option value="">Loading...</option>')
        $.ajax({
            success: function(html){
                $('#courier').empty()
                $('#courier').append('<option value="">Pilih Kurir</option>')
                $('#courier').append(`
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                    `)
            }
        });
    })

    $('#courier').on('change', function() {
            $('#ongkir').empty()
            $('#ongkir').append('Loading...')
            $.ajax({
                url:"{{ url('/api/cost') }}",
                type: "POST",
                data: {
                        destination:         $('select[name=district_id]').val(),
                        courier:             $('select[name=courier]').val(),
                        weight:              $('#weight').val(),
                    },
                success: function (response) {
                    if (response) {
                        $('#ongkos').val(response[0].value)
                        var ongkir = numeral(response[0]['value']).format('0,0');
                        let subtotal = "{{ $subtotal }}"
                        $('#ongkir').text('Rp.' + ongkir);
                        let total = parseInt(subtotal) + parseInt(response[0]['value'])
                        var hasil = numeral(total).format('0,0');
                        $('#total').text('Rp.' + hasil)
                    }
                },
                error: function (response) {
                    console.log('Error:', response);
                }
            });
        })
</script>
@endsection
