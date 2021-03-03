@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @role('superadmin')
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">
                    {{$product->count()}}
                    <small>Produk</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pesanan</span>
                    <span class="info-box-number">
                        {{$order->count()}}
                        <small>Baru</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Return</span>
                    <span class="info-box-number">
                        {{$retur->count()}}
                        <small>Produk</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">User/Admin</span>
                <span class="info-box-number">
                    {{$user->count()}}
                    <small>Orang</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>List Data Stock Harian</h3>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Stock</th>
                                        <th>Catatan</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($daily as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td><strong>{{ $row->stock }}</strong> <span class="badge badge-info">{{$row->qty}}</span></td>
                                            <td>{{ $row->catatan }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <h3 style="color: #ffb19d">List Stock Harian masih kosong</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($daily->count())
                        <div class="card-footer">
                            <h3>Total stock saat ini : <strong>{{ $daily->sum('stock') }}</strong></h3>
                        </div>
                        @endif
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endrole

    @role('admin')
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">
                    {{$product->count()}}
                    <small>Produk</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pesanan</span>
                    <span class="info-box-number">
                        {{$order->count()}}
                        <small>Baru</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Return</span>
                    <span class="info-box-number">
                        {{$retur->count()}}
                        <small>Produk</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Member</span>
                <span class="info-box-number">
                    {{$customer->count()}}
                    <small>Orang</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        {{-- session stock --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>List Data Stock Harian</h3>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Stock</th>
                                        <th>Catatan</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($daily as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td><strong>{{ $row->stock }}</strong> <span class="badge badge-info">{{$row->qty}}</span></td>
                                            <td>{{ $row->catatan }}</td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <h3 style="color: #ffb19d">List Stock Harian masih kosong</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($daily->count())
                        <div class="card-footer">
                            <h3>Total stock saat ini : <strong>{{ $daily->sum('stock') }}</strong></h3>
                        </div>
                        @endif
                </div>
            </div>
        </div>
        <!-- /.row -->
    @endrole

    @role('gudang')
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">
                    {{$product->count()}}
                    <small>Produk</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pesanan</span>
                    <span class="info-box-number">
                        {{$order->count()}}
                        <small>Baru</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Return</span>
                    <span class="info-box-number">
                        {{$retur->count()}}
                        <small>Produk</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-archive"></i></span>

                <div class="info-box-content">
                <span class="info-box-text">Stok Produk</span>
                <span class="info-box-number">
                        {{$product->sum('stock')}}
                        <small>Produk</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <form action="{{route('daily.post')}}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4>Add Data Stock Harian</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Produk</label>
                                <input type="text" id="name" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                            <div>
                                <label for="qty">Quantiti</label>
                                <select name="qty" class="form-control" required>
                                    <option value="">Pilih Quantiti</option>
                                    <option value="dus">Dus</option>
                                    <option value="picis">Picis</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('qty') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="catatan">Catatan</label>
                                <textarea name="catatan" id="catatan" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-right" type="submit">Add Stock Harian</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <h3>List Data Stock Harian</h3>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Stock</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($daily as $row)
                                        <tr>
                                            <td>{{ $row->name }}</td>
                                            <td><strong>{{ $row->stock }}</strong> <span class="badge badge-info">{{$row->qty}}</span></td>
                                            <td>{{ $row->catatan }}</td>
                                            <td>
                                                <form action="{{ route('daily.destroy',$row->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('daily.edit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> |
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <h3 style="color: #ffb19d">List Stock Harian masih kosong</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @if ($daily->count())
                        <div class="card-footer">
                            <h3>Total stock saat ini : <strong>{{ $daily->sum('stock') }}</strong></h3>
                        </div>
                        @endif
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
