@extends('adminlte::page')

@section('title', 'Edit Stock Harian')

@section('content_header')
    <h1>Edit Stock Harian</h1>
@stop

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Stock Harian</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$daily->product->name}}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('daily.update', $daily->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="number" name="stock" value="{{ $daily->stock }}" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea name="catatan" id="catatan" class="form-control" cols="30" rows="5">{{ $daily->catatan }}</textarea>
                                    </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
