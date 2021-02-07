@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('users.set_role', $user->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Set Role</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <td>:</td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>:</td>
                                            <td>
                                                @foreach ($roles as $row)
                                                <input type="radio" name="role"
                                                    {{ $user->hasRole($row) ? 'checked':'' }}
                                                    value="{{ $row }}"> {{  $row }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-right">
                                Set Role
                            </button>
                        </div>
                    </div>
                    </form>
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
