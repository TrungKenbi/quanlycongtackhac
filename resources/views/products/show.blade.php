@extends('layouts.app')

@section('title', 'Xem Công Tác')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tên Công Tác:</strong>
                {{ $product->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Mô tả chi tiết:</strong>
                {{ $product->detail }}
            </div>
        </div>
    </div>
</div>
@endsection
