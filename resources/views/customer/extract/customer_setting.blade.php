@extends('layouts.template')

@section('title')
    Member Setting
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
                <h1>Setting Profile</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setting Profile</li>
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
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            <form class="row login_form" action="{{ route('customer.setting') }}" method="post">
                @csrf
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Update Akun</h3>
                        <div class="col-md-12 form-group">
                            <input type="text" name="name" class="form-control" required value="{{ $customer->name }}" placeholder="Nama Lengkap">
                            <p class="text-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" name="email" class="form-control" required value="{{ $customer->email }}" readonly>
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" name="password" class="form-control" placeholder="password">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                            <p>Biarkan kosong jika tidak ingin mengganti password</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" name="phone_number" class="form-control" required value="{{ $customer->phone_number }}" placeholder="Nomor HP/Whatsapp">
                            <p class="text-danger">{{ $errors->first('phone_number') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login_form_inner register_form_inner">
                        <h3>Update Akun</h3>
                        <div class="col-md-12 form-group">
                            <input type="text" name="address" class="form-control" required value="{{ $customer->address }}" placeholder="Alamat">
                            <p class="text-danger">{{ $errors->first('address') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <select class="form-control" name="province_id" id="province_id" required>
                                <option value="">Pilih Propinsi</option>
                                @foreach ($provinces as $row)
                                <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('province_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <select class="form-control" name="city_id" id="city_id" required>
                                <option value="">Pilih Kabupaten/Kota</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('city_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <select class="form-control" name="district_id" id="district_id" required>
                                <option value="">Pilih Kecamatan</option>
                            </select>
                            <p class="text-danger">{{ $errors->first('district_id') }}</p>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" class="button w-100">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->
</main>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        loadCity($('#province_id').val(), 'bySelect').then(() => {
            loadDistrict($('#city_id').val(), 'bySelect');
        })
    })
    $('#province_id').on('change', function() {
        loadCity($(this).val(), '');
    })
    $('#city_id').on('change', function() {
        loadDistrict($(this).val(), '')
    })
    function loadCity(province_id, type) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: "{{ url('/api/city') }}",
                type: "GET",
                data: { province_id: province_id },
                success: function(html){
                    $('#city_id').empty()
                    $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                    $.each(html.data, function(key, item) {
                        let city_selected = {{ $customer->district->city_id }};
                        let selected = type == 'bySelect' && city_selected == item.id ? 'selected':'';
                        $('#city_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                        resolve()
                    })
                }
            });
        })
    }
    function loadDistrict(city_id, type) {
        $.ajax({
            url: "{{ url('/api/district') }}",
            type: "GET",
            data: { city_id: city_id },
            success: function(html){
                $('#district_id').empty()
                $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                $.each(html.data, function(key, item) {
                    let district_selected = {{ $customer->district->id }};
                    let selected = type == 'bySelect' && district_selected == item.id ? 'selected':'';
                    $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>')
                })
            }
        });
    }
</script>
@endsection
