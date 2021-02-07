@extends('adminlte::page')

@section('title', 'User-Index')

@section('content_header')
    <h1>User Index</h1>
@stop

@section('content')
<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card-header with-border">
                            <h3 class="card-title">List Users</h3>
                            <a href="{{ route('users.create') }}" class="float-right btn btn-primary btn-sm">Tambah Baru</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Nama</td>
                                            <td>Email</td>
                                            <td>Role</td>
                                            <td>Status</td>
                                            <td>Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($users as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                @foreach ($row->getRoleNames() as $role)
                                                <label for="" class="badge badge-info">{{ $role }}</label>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($row->status)
                                                <label class="badge badge-success">Aktif</label>
                                                @else
                                                <label for="" class="badge badge-default">Suspend</label>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('users.destroy', $row->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{ route('users.roles', $row->id) }}" class="btn btn-info btn-sm"><i class="fa fa-user-secret"></i></a>
                                                    <a href="{{ route('users.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
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
    </section>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
