@extends('adminlte::page')

@section('title', 'edit CS')

@section('content_header')
    <h1>Edit Berita</h1>
@stop

@section('content')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Edit Berita</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Berita</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('post.update', $news->id) }}" method="post" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $news->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="link">Link Berita</label>
                                    <input type="text" name="link" id="link" class="form-control" value="{{ $news->link }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="body">Body</label>
                                    <textarea name="body" id="body" class="form-control" cols="30" rows="5" required>{{ $news->body }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sumber">Sumber Berita</label>
                                    <input type="text" name="sumber" id="sumber" class="form-control" value="{{ $news->sumber }}" required>
                                </div>
                                <div class="form-group">
                                    <p>Kosongkan jika tidak ingin merubah</p>
                                    <label for="staus">Status</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Silahkan Pilih</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Pending</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Gambar</label>
                                    <br>
                                    <img src="{{ asset('storage/news/' . $news->image) }}" width="100px" height="100px" alt="{{ $news->title }}">
                                    <hr>
                                    <input type="file" name="image" id="image" class="form-control">
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
