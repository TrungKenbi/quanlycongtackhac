<?php

namespace App\Exports;

use App\Models\OtherWork;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithMapping;


class OtherWorksExport implements Responsable, FromView, WithMapping
{
    use Exportable;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
        $user = User::where('id', $user_id)->first('name');
        $this->fileName = 'cong-tac-khac-' . Str::slug($user->name, '-') . '.xlsx';
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

    /**
     * @inheritDoc
     */
    public function query()
    {
        return OtherWork::query()->where('user_id', $this->user_id);
    }


    public function view(): View
    {
        return view('exports.otherworks', [
            'otherworks' => OtherWork::where('user_id', $this->user_id)->get(),
            'user' => User::find($this->user_id),
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
