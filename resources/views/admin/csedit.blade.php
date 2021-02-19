@extends('adminlte::page')

@section('title', 'edit CS')

@section('content_header')
    <h1>Edit CS</h1>
@stop

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit CS</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit CS</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cs.update', $cs->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">Nama CS</label>
                                    <input type="text" name="name" class="form-control" value="{{ $cs->name }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="message">Pesan</label>
                                    <textarea name="message" id="message" class="form-control" cols="30" rows="5" required>{{ $cs->message }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor HP</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="phone">+62</span>
                                        <input type="tel" name="phone" class="form-control" value="{{ preg_replace("/^62/", "0", $cs->phone) }}" placeholder="08xxxxxxxxx" aria-label="phone" aria-describedby="phone" required>
                                    </div>
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
