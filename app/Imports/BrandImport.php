<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BrandImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    /**
     * @param array $row
     * 
     * @return Brand|null
     */
    public function model(array $row)
    {
        $brand_names = Brand::pluck('name')->toArray();

        $array = [];

        foreach ($brand_names as $brand_name) {
            if ($brand_name !== $row['name']) {
                $array[] = [
                    'user_id' => $row['user_id'],
                    'name' => $row['name'],
                    'image_path' => null,
                    'image_url' => $row['image_url'],
                ];
            }
        }
        // if (!in_array($row['name'], $brand_names)) {
        //     $array[] = [
        //         'user_id' => $row['user_id'],
        //         'name' => $row['name'],
        //         'image_path' => null,
        //         'image_url' => $row['image_url'],
        //     ];
            // return new Brand([
            //     'user_id' => $row['user_id'],
            //     'name' => $row['name'],
            //     'image_path' => null,
            //     'image_url' => $row['image_url'],
            // ]);
        // } else {
        //     return null;
        // }

        \dd($array);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    // public function rules(): array
    // {
    //     return [
    //         'name' => 'unique:brands',
    //     ];
    // }

    // public function customValidationMessages()
    // {
    //     return [
    //         'name.unique' => 'This brand has already been added',
    //     ];
    // }
}
