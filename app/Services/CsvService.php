<?php

namespace App\Services;

use App\Imports\PokemonImport;
use CsvInterface;
use Maatwebsite\Excel\Facades\Excel;

class CsvService implements CsvInterface
{
    public function import(string $file)
    {
        Excel::import(new PokemonImport, $file);
    }

}
