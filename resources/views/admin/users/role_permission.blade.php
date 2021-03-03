@extends('adminlte::page')

@section('title', 'Role Permission')

@section('css')
    <style type="text/css">
        .tab-pane{
            height:150px;
            overflow-y:scroll;
        }
    </style>
@endsection

@section('content_header')
    <h1>Role Permission</h1>
@stop

@section('content')
<div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header with-border">
                            <h4 class="card-title">Add New Permission</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.add_permission') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        Add New
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header with-border">
                            <h3 class="card-title">Set Permission to Role</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.roles_permission') }}" method="GET">
                                <div class="form-group">
                                    <label for="">Roles</label>
                                    <div class="input-group">
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $value)
                                                <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger">Check!</button>
                                        </span>
                                    </div>
                                </div>
                            </form>

                            {{-- jika $permission tidak bernilai kosong --}}
                            @if (!empty($permissions))
                                <form action="{{ route('users.setRolePermission', request()->get('role')) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1" data-toggle="tab">Permissions</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    @php $no = 1; @endphp
                                                    @foreach ($permissions as $key => $row)
                                                        <input type="checkbox"
                                                            name="permission[]"
                                                            class="minimal-red"
                                                            value="{{ $row }}"
                                                            {{--  CHECK, JIKA PERMISSION TERSEBUT SUDAH DI SET, MAKA CHECKED --}}
                                                            {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                            > {{ $row }} <br>
                                                        @if ($no++%4 == 0)
                                                        <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pull-right">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-send"></i> Set Permission
                                        </button>
                                    </div>
                                </form>
                            @endif
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
