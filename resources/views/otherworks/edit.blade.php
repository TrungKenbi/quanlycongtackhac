@extends('layouts.app')

@section('title', 'Chỉnh Sửa Công Tác')
@section('content')
<div class="container-fluid">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi!</strong> Dữ liệu nhập vào không chính xác:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('otherworks.update', $otherwork->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tên Công Tác:</strong>
                    <input type="text" name="name" value="{{ $otherwork->name }}" class="form-control" placeholder="Tên Công Tác">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Mô tả chi tiết:</strong>
                    <textarea class="form-control" id="editor" name="detail" rows="10">{{ $otherwork->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .ck-editor__editable {
        min-height: 400px;
    }
</style>
@endpush

@push('scripts')
<script src="/assets/libs/ckeditor5-build-classic/ckeditor.js"></script>
<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ CKFinder ],
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            ckfinder: {
                // Upload the images to the server using the CKFinder QuickUpload command.
                uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json'
            }
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( err => {
            console.error( err.stack );
        } );
</script>
@endpush


