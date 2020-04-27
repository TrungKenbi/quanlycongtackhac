@extends('layouts.app')

@section('title', 'Báo Cáo Theo Giảng Viên')
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
                    <th>Khoa</th>
                    <th>Tên Giảng Viên</th>
                    <th>Số giờ công tác</th>
                    <th>Chỉ tiêu</th>
                    <th width="30%">Công Tác Khác</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <b>
                                @php
                                    $departments = [];
                                    $roles = $user->roles;
                                    foreach ($roles as $role)
                                        if ($role->id > 3)
                                            $departments[] = $role;
                                @endphp
                                @foreach($departments as $department)
                                    <label class="label label-success">
                                        {{ $department->name }}
                                    </label>
                                @endforeach
                            </b>
                        </td>
                        <td><b>{{ $user->name }}</b></td>
                        <td><b style="text-transform: uppercase;">{{ $hourWork = $user->all_working_time }}</b></td>
                        <td><b style="text-transform: uppercase;">{{ $user->target_point }}</b></td>
                        <td>
                            @php
                                $percent = (int)($hourWork / $user->target_point * 100);
                                $percent_real = $percent;
                                $percent = $percent > 100 ? 100 : $percent;
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ $percent_real }}%</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            @if ($users->count() == 0)
                <div class="alert alert-warning text-center">Chưa có dữ liệu ... </div>
            @endif
        </div>
        <div class="d-flex justify-content-center">
            {!! $users->links() !!}
        </div>
    </div>
@endsection
