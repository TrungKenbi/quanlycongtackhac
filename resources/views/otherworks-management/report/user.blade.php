@extends('layouts.app')

@section('title', 'Quản Lý Công Tác')
@section('content')
    <div class="container-fluid">
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
                    <th>Số giờ công tác</th>
                    <th width="30%">Công Tác Khác</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><b style="text-transform: uppercase;">{{ $user->name }}</b></td>
                        <td><b style="text-transform: uppercase;">{{ $hourWork = $user->getHourWork() }}</b></td>
                        <td>
                            @php
                                $percent = (int)($hourWork / 270 * 100);
                                $percent = $percent > 100 ? 100 : $percent;
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ $percent }}%</div>
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
