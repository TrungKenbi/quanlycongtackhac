@extends('layouts.app')

@section('title', 'Xem Quyền')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Key-Permission:</strong>
                {{ $permission->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Guard Name:</strong>
                {{ $permission->guard_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Thời gian tạo:</strong>
                {{ $permission->created_at->format('H:i d/m/Y') }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Thời gian cập nhật:</strong>
                {{ $permission->updated_at->diffForHumans() }}
            </div>
        </div>
    </div>
</div>
@endsection
