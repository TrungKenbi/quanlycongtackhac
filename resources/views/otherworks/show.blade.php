@extends('layouts.app')

@section('title', 'Xem Công Tác')
@section('content')
<div class="container-fluid">
    <h3 class="text-center">{{ $otherwork->name }}</h3>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <hr>
        {!! $otherwork->detail !!}

        <br/><br/><br/><br/>
        <hr>

        <h4>Số giờ công tác</h4>
        <ul>
            <li>Định mức theo quy định: <b>{{ $otherwork->norm }}</b></li>
            <li>Số lượng: <b>{{ $otherwork->count }}</b></li>
            <li>Tổng: <b>{{ $otherwork->norm*$otherwork->count*(103/320) }}</b></li>
        </ul>

        <h4>Tài liệu minh chứng</h4>
        @if (count($documents) > 0)
            @foreach($documents as $document)
                <a href="{{ route('otherworks.downloadFile', $document->id)  }}">{{ $document->display_name }}</a> <br/>
            @endforeach
        @else
            <small>Không có tài  liệu</small>
        @endif
        <h4>Hình ảnh minh chứng</h4>
        @if (count($photos) > 0)
            @foreach($photos as $photo)
                <a href="{{ asset('storage/' . $photo->filename) }}" target="_blank">
                    <img src="{{ asset('storage/' . $photo->filename) }}" alt="" style="max-height: 100px;">
                </a><br/>
            @endforeach
        @else
            <small>Không có hình ảnh</small>
        @endif
    </div>
</div>
@endsection
