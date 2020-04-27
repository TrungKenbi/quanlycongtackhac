@extends('layouts.app')

@section('title', 'Tạo Công Tác Mới')
@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Lỗi !</strong> Dữ liệu nhập vào không chính xác:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form class="form-horizontal" action="{{ route('otherworks.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <h3>Tên Công Tác</h3>
                    <input type="text" name="name" class="form-control" placeholder="Tên Công Tác" value="{{ old('name') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <h3>Nội dung công tác</h3>
                    <textarea class="form-control" style="height:150px" name="detail" id="editor">{{ old('detail') }}</textarea>
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <h3>Định mức theo quy định</h3>
                    <input type="text" name="norm" class="form-control" placeholder="Định mức theo quy định" value="{{ old('norm') }}">
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <h3>Số lượng</h3>
                    <input type="text" name="count" class="form-control" placeholder="Số lượng" value="{{ old('count') }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <h3>Tài liệu minh chứng</h3>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <input id="inputGroupFile01" name="documents[]" type="file" multiple class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile01">Chọn tài liệu minh chứng cho công tác (Có thể chọn nhiều tập tin)</label>
                    </div>
                </div>
                <br/><br/><br/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h3>Hình ảnh minh chứng</h3>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <input id="inputGroupFile02" name="photos[]" type="file" multiple class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile02">Chọn hình ảnh minh chứng cho công tác (Có thể chọn nhiều tập tin)</label>
                    </div>
                </div>
                <br/><br/><br/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Tạo Công Tác</button>
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
    <script src="/assets/libs/ckeditor5-build-classic/translations/vi.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                //toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ],
                language: 'vi'
            } )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );
    </script>
@endpush
