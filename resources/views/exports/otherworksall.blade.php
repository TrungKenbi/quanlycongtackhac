<table style="border-collapse: collapse;">
    <thead>
    <tr>
        <td></td>
        <td colspan="5" style="text-align: center; font-size: 24px;"><b>CÔNG TÁC KHÁC</b></td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th style="width: 5px;"></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 5px; "><b>TT</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 25px;"><b>Giảng Viên</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 25px;"><b>Khoa</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 50px;"><b>Nội dung</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 20px; word-wrap: break-word;"><b>Định mức theo quy định</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 20px"><b>Số lượng</b></th>
        <th style="text-align: center; vertical-align: middle; border: 1px solid black; width: 20px"><b>Tổng</b></th>
    </tr>
    </thead>
    <tbody>
    @php
        $i = 1;
        $total = 0;
    @endphp
    @foreach($otherworks as $otherwork)
        @php
            $total_row = $otherwork->total_point;
            $total += $total_row;
        @endphp
        <tr>
            <td></td>
            <td style="text-align: center; vertical-align: middle; border: 1px solid black;">{{ $i++ }}</td>
            <td style="text-align: left; vertical-align: middle; border: 1px solid black;">{{ $otherwork->getUser->name }}</td>
            <td style="text-align: left; vertical-align: middle; border: 1px solid black;">
                @php
                    $departments = $otherwork->getUser->name_departments;
                    foreach ($departments as $department) {
                            echo $department;
                            break;
                    }
                @endphp
            </td>
            <td style="text-align: left; vertical-align: middle; border: 1px solid black;">{{ $otherwork->name }}</td>
            <td style="text-align: center; vertical-align: middle; border: 1px solid black;">{{ $otherwork->norm }}</td>
            <td style="text-align: center; vertical-align: middle; border: 1px solid black;">{{ $otherwork->count }}</td>
            <td style="text-align: center; vertical-align: middle; border: 1px solid black;">{{ $total_row }}</td>
        </tr>
    @endforeach
    <tr>
        <td></td>
        <td style="border: 1px solid black;"></td>
        <td style="text-align: center; border: 1px solid black;"><b>TỔNG CỘNG</b></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="border: 1px solid black;"></td>
        <td style="text-align: center; border: 1px solid black;"><b>{{ (int)$total }}</b></td>
    </tr>
    </tbody>
</table>
