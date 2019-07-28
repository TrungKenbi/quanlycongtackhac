@extends('layouts.app')

@section('title', 'Quản Lý Chức Vụ')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('roles.create') }}"> Tạo chức vụ mới</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" style="text-align:center;">
        <tr>
            <th>ID</th>
            <th>Chức vụ</th>
            <th>Quyền</th>
            <th width="280px">Thao tác</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @if(!empty($permissions[$loop->index]))
                        @foreach($permissions[$loop->index] as $v)
                            <label class="label label-success">{{ $v->name }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Sửa</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
</div>
@endsection
