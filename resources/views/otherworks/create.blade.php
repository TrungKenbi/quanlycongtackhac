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


    <form action="{{ route('otherworks.store') }}" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <h3>Tên Công Tác</h3>
                    <input type="text" name="name" class="form-control" placeholder="Tên Công Tác">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <h3>Nội dung công tác</h3>
                    <textarea class="form-control" style="height:150px" name="detail" id="editor"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" id="div_invite">
                <div class="form-group">
                    <h3>Người Tham Gia</h3>
                    <ul id="list-invate">
                    </ul>
                    <input type="text" class="form-control search-invite" placeholder="Người tham gia">
                    <input type="hidden" name="users[]" id="invite" value="">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h3>Văn Bản</h3>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <input id="inputGroupFile02" name="documents[]" type="file" multiple class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile02">Chọn file văn bản minh chứng</label>
                    </div>
                </div>
                <br/><br/><br/>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <h3>Hình Ảnh</h3>
                <div class="input-group mt-3">
                    <div class="custom-file">
                        <input id="inputGroupFile02" name="photos[]" type="file" multiple class="custom-file-input">
                        <label class="custom-file-label" for="inputGroupFile02">Chọn file hình ảnh minh chứng</label>
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

        .list-user {
            background: #cddeff;
            display: inline-block;
            margin: 5px;
            padding: 5px;
            border-radius: 5px;
        }

        .list-user:after {
            padding-left: 5px;
            content: 'x';
            font-weight: bold;
            font-size: large;
        }

        .list-user:hover:after {
            color: red;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="/assets/libs/ckeditor5-build-classic/ckeditor.js"></script>
    <script src="/js/typeahead.bundle.min.js"></script>
    <script>

        var users = [];

        function addUserInvite(user) {
            users.push(user.id);
            $("#list-invate").append("<li class='list-user' onclick='removeUser();'>" + user.name + "</li>");
            document.getElementById("invite").value = users;
        }

        function removeUser()
        {
            //alert("hihi");
        }

        $(document).ready(function () {
            bsCustomFileInput.init();
            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( err => {
                    console.error( err.stack );
                } );



            var engine = new Bloodhound({
                remote: {
                    url: '/search/name?value=%QUERY%',
                    wildcard: '%QUERY%'
                },
                datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace
            });

            $(".search-invite").typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                    source: engine.ttAdapter(),
                    name: 'invite-name',
                    display: function(data) {
                        return '';
                    },
                    templates: {
                        empty: [
                            '<div class="header-title">...</div><div class="list-group search-results-dropdown"><div class="list-group-item">Không tìm thấy</div></div>'
                        ],
                        header: [
                            '<div class="header-title">Có phải là: </div><div class="list-group search-results-dropdown"></div>'
                        ],
                        suggestion: function (data) {
                            return `<a href="#div_invite" onclick='addUserInvite(` + JSON.stringify(data) + `);' class="list-group-item">` + data.name + `</a>`;
                        }
                    }
                }
            );


        });
    </script>
@endpush
