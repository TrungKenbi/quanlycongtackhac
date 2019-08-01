@extends('layouts.app')

@section('title', 'Quản Lý Quyền')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('permissions.create') }}"> Tạo Quyền Mới</a>
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
            <th style="font-weight: bold">ID</th>
            <th style="font-weight: bold">Key</th>
            <th style="font-weight: bold">Tên Quyền</th>
            <th style="font-weight: bold" width="250px">Thao tác</th>
        </tr>
        @foreach ($permissions as $key => $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ __('permission.' . $permission->name) }}</td>
                <td>
                    @can('permission-edit')
                        <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Sửa</a>
                    @endcan
                    @can('permission-delete')
                        {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $permissions->render() !!}
</div>
@endsection
