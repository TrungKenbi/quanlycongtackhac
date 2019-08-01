@extends('layouts.app')

@section('title', 'Tạo Quyền')
@section('content')
<div class="container-fluid">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Dữ liệu nhập vào không chính xác.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(array('route' => 'permissions.store', 'method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Key Permission:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Key Permission','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Tạo Quyền</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
