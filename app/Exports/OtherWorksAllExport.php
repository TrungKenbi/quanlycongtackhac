<?php

namespace App\Exports;

use App\Models\OtherWork;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithMapping;


class OtherWorksAllExport implements Responsable, FromView, WithMapping
{
    use Exportable;

    public function __construct()
    {
        $this->fileName = 'cong-tac-khac-all.xlsx';
    }

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'otherworks.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        //return OtherWork::all();
    }


    public function view(): View
    {
        return view('exports.otherworksall', [
            'otherworks' => OtherWork::all()
        ]);
    }

    /**
     * @inheritDoc
     */
    public function map($otherwork): array
    {
        return [
            $otherwork->id,
            Date::dateTimeToExcel($otherwork->created_at),
        ];
    }
}
