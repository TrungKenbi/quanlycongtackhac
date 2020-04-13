@extends('layouts.app')

@section('title', 'Quản Lý Công Tác')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb" style="padding-bottom: 10px">
            <div class="pull-right">
                @can('otherwork-create')
                    <a class="btn btn-success" href="{{ route('otherworks.create') }}"> Tạo Công Tác</a>
                @endcan

                @can('otherwork-export')
                    <a class="btn btn-info" href="{{ route('otherworks.export') }}"> Xuất Excel</a>
                @endcan

            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <style>
        .title-otherwork {
            color: #3e5569;
        }

        .title-otherwork:hover {
            color: black;
        }
    </style>

    <div class="text-center">
        <h3>Đã tham gia {{ $otherworksCount }} công tác và tích luỹ được <b>{{ $otherworksPointSum }}</b> giờ</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>STT</th>
                <th>Tên Công Tác</th>
                <th>Định mức</th>
                <th>Số lượng</th>
                <th>Tổng</th>
                <th width="200px">Thao Tác</th>
            </tr>
            @foreach ($otherworks as $otherwork)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        <a href="{{ route('otherworks.show', $otherwork->id) }}" class="title-otherwork">
                            <b style="text-transform: uppercase;">{{ $otherwork->name }}</b>
                        </a>
                    </td>
                    <td><b style="text-transform: uppercase;">{{ $otherwork->norm }}</b></td>
                    <td><b style="text-transform: uppercase;">{{ $otherwork->count }}</b></td>
                    <td><b style="text-transform: uppercase;">{{ $otherwork->total_point }}</b></td>
                    <td>
                        <form action="{{ route('otherworks.destroy',$otherwork->id) }}" method="POST">
                            <a class="btn btn-info" href="{{ route('otherworks.show', $otherwork->id) }}">Xem</a>
                            @can('otherwork-edit')
                                <a class="btn btn-primary" href="{{ route('otherworks.edit', $otherwork->id) }}">Sửa</a>
                            @endcan

                            @csrf
                            @method('DELETE')
                            @can('otherwork-delete')
                                <button type="submit" onclick="return confirm('Bạn có chắc chắn xoá vĩnh viễn công tác này ?')" class="btn btn-danger">Xóa</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {!! $otherworks->links() !!}
    </div>
</div>
@endsection
