@extends('adminlte::page')

@section('title', 'Other')

@section('content_header')
    <h1>Other</h1>
@stop

@section('content')
    @role('admin')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Other</li>
    </ol>
        @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        {{-- session cs --}}
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <form action="{{route('cs.post')}}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4>Add Data CS</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama CS</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Pesan</label>
                                <textarea name="message" id="message" class="form-control" cols="30" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="staus">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor HP</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="phone">+62</span>
                                    <input type="tel" name="phone" class="form-control" placeholder="08xxxxxxxxx" aria-label="phone" aria-describedby="phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit">Add CS</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <form action="{{route('post.news')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Add Berita</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="link">Link Berita</label>
                                        <input type="text" name="link" id="link" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea name="body" id="body" class="form-control" cols="30" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sumber">Sumber Berita</label>
                                        <input type="text" name="sumber" id="sumber" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="staus">Status</label>
                                        <select name="status" class="form-control" id="status">
                                            <option value="1">Aktif</option>
                                            <option value="0">Pending</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Gambar</label>
                                        <input type="file" name="image" id="image" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit">Add Berita</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- session news --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>List Data CS</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Nama</th>
                                    <th>Pesan</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($cs as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->message }}</td>
                                        <td>{{ preg_replace("/^62/", "0", $row->phone) }}</td>
                                        <td>
                                            @if ($row->status != 1)
                                                Pending
                                            @else
                                                Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('cs.delete',$row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('cs.edit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <hr style="color: #f27272">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                <hr style="color: #f27272">
                                                <a class="btn btn-success" href="https://wa.me/{{$row->phone}}?text={{ urlencode(strtolower($row->message)) }}"><i class="fas fa-comments"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <h3 style="color: #ffb19d">List CS masih kosong</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $cs->links('pagination::simple-bootstrap-4') !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>List Data Berita</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Link</th>
                                    <th>Sumber</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($news as $row)
                                    <tr>
                                        <td><img src="{{ asset('storage/news/' . $row->image) }}" width="100px" height="100px" alt="{{ $row->title }}"></td>
                                        <td>{{ substr($row->title, 0, 20) }}...</td>
                                        <td>{{ substr($row->body, 0, 20) }}...</td>
                                        <td><a href="{{ $row->link }}" target="_blank" rel="{{ $row->title }}">{{ substr($row->link, 0, 20) }}...</a></td>
                                        <td>{{ $row->sumber }}</td>
                                        <td>
                                            @if ($row->status != 1)
                                                Pending
                                            @else
                                                Aktif
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('post.delete', $row->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{ route('post.edit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <hr style="color: #f27272">
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                <h3 style="color: #ffb19d">List Berita masih kosong</h3>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! $news->links('pagination::simple-bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endrole
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
