<?php

namespace App\Exports;

use App\Models\Beneficiary;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class BeneficiariesExport implements FromCollection, WithTitle, WithHeadings, WithMapping, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Beneficiary::all();
    }

      /**
     * @return string
     */
    public function title(): string
    {
        return 'Beneficiaries';
    }

    public function map($value) : array
    {
        return [
            $value->effect_id,
            $value->id,
            $value->beneficiary_type->id,
            $value->beneficiary_type->name,
            $value->description,
        ];
    }

    public function headings(): array
    {
        return [
            'effect_id',
            'id',
            'type_id',
            'type_name',
            'description',
        ];
    }
}
