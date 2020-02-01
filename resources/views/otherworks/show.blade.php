@extends('layouts.app')

@section('title', 'Xem Công Tác')
@section('content')
<div class="container-fluid">
    <h3 class="text-center">{{ $otherwork->name }}</h3>
    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! $otherwork->detail !!}

        <br/><br/><br/><br/>
        <h4>Văn bản</h4>
        @foreach($documents as $document)
            <a href="{{ route('downloadFile', $document->id)  }}">{{ $document->display_name }}</a> <br/>
        @endforeach
        <h4>Hình ảnh</h4>
        @foreach($photos as $photo)
            <img src="{{ asset('storage/' . $photo->filename) }}" alt="" style="max-height: 100px;"><br/>
        @endforeach
    </div>
</div>
@endsection
