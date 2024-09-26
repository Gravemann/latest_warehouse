<?php

namespace App\Exports;

use App\Http\Resources\Brand\BrandResouce;
use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BrandExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BrandResouce::collection(Brand::all());
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'User Id',
            'Name',
            'Created At',
            'Updated At'
        ];
    }

    /**
     * @param mixed $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->user_id,
            $row->name,
            $row->created_at,
            $row->updated_at
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'B' => 23,
    //     ];
    // }
}
