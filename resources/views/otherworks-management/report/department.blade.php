@extends('layouts.app')

@section('title', 'Báo Cáo Theo Khoa')
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
                    <th>Số giảng viên</th>
                    <th>Tổng giờ công tác</th>
                    <th width="30%">Công Tác Khác</th>
                    <th>Chi tiết</th>
                </tr>
                @foreach ($departments as $department)
                    @php
                        $total_point = 0;
                        $total_target_point = 0;
                        $users = $department->users()->get(['id', 'formula', 'target_point']);
                        foreach ($users as $user) {
                            $otherworks = $user->otherworks()->get(['norm', 'count']);
                            foreach ($otherworks as $otherwork) {
                                $total_point += pointCalculation($user->formula, $otherwork->norm, $otherwork->count);
                            }
                            $total_target_point += $user->target_point;
                        }
                        $total_point = (int)$total_point;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><b>{{ $department->name }}</b></td>
                        <td><b>{{ $department->users()->count('*') }}</b></td>
                        <td><b>{{ $total_point }}</b></td>
                        <td>
                            @php
                                if ($total_target_point == 0)
                                    $total_target_point = 1;
                                $percent = (int)($total_point / $total_target_point * 100);
                                $percent_real = $percent;
                                $percent = $percent > 100 ? 100 : $percent;
                            @endphp
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0" aria-valuemax="100">{{ $percent_real }}%</div>
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('otherworks-management.reportUser') }}?department=<?=$department->id?>">Xem</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {!! $departments->links() !!}
        </div>
    </div>
@endsection
