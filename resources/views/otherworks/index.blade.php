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
                <td><b style="text-transform: uppercase;">{{ $otherwork->name }}</b></td>
                <td><b style="text-transform: uppercase;">{{ $otherwork->norm }}</b></td>
                <td><b style="text-transform: uppercase;">{{ $otherwork->count }}</b></td>
                <td><b style="text-transform: uppercase;">{{ $otherwork->norm*$otherwork->count*(103/320) }}</b></td>
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
    {!! $otherworks->links() !!}
</div>
@endsection
