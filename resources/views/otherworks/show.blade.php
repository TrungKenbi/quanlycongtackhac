@extends('layouts.app')

@section('title', 'Xem Công Tác')
@section('content')
<div class="container-fluid">
    <h1 class="text-center">{{ $otherwork->name }}</h1>
    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! $otherwork->detail !!}
    </div>
</div>
@endsection
