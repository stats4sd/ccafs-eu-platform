<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ActivitiesExport implements FromCollection,  WithTitle, WithHeadings, WithMapping, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Activity::all();
    }

     /**
     * @return string
     */
    public function title(): string
    {
        return 'Activities';
    }

    public function map($value) : array
    {
        return [
            $value->id,
            $value->output_id,
            $value->name,

        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'output_id',
            'name'
        ];
    }
}
