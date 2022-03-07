<?php

namespace App\Console\Commands;

use App\Services\CsvService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;

class ImportPokemonCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:pokemons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or Update data in the pokemons table via the csv
     storage/app/csv/{filename}.csv, default pokemon.csv';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        print_r('About to import csv data');
        if (!Storage::exists("/csv/pokemon.csv")) {
            throw new FileNotFoundException(
                "storage/app/csv/pokemon.csv does not exist"
            );
        }
        $file = Storage_path('app/csv/pokemon.csv');
        $csvService = new CsvService();
        $csvService->import($file);

        print_r('Csv data import complete');
    }
}
