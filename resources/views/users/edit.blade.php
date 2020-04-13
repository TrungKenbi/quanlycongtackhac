@extends('layouts.app')

@section('title', 'Chỉnh Sửa Người Dùng')
@section('content')
<div class="container-fluid">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Có lỗi!</strong> Dữ liệu nhập không chính xác !<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Họ và Tên:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Họ và Tên  ','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Công thức tính công tác:</strong>
                {!! Form::text('formula', null, array('placeholder' => 'Công thức tính công tác', 'class' => 'form-control')) !!}
                <small><b>{norm}</b>: Định mức, <b>{count}</b>: Số lượng</small>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mật khẩu:</strong>
                {!! Form::password('password', array('placeholder' => 'Mật khẩu','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nhập lại mật khẩu:</strong>
                {!! Form::password('confirm-password', array('placeholder' => 'Nhập lại mật khẩu','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Chức vụ:</strong>
                {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
