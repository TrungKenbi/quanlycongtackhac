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

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Tên Giảng Viên</th>
                    <th width="30%">Công Tác Khác</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><b style="text-transform: uppercase;">{{ $user->name }}</b></td>
                        <td>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
@endsection
