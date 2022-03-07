<?php

namespace App\Imports;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PokemonImport implements ToModel, WithBatchInserts, WithUpserts, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'input_encoding' => 'ISO-8859-1'
        ];
    }

    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        return new Pokemon([
            'identifier' => $row[1],
            'species_id' => $row[2],
            'height' => $row[3],
            'weight' => $row[4],
            'base_experience' => $row[5],
            'order' => $row[6],
            'is_default' => $row[7]
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy(): string
    {
        return 'order';
    }
}
