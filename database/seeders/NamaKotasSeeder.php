<?php

namespace Database\Seeders;

use App\Models\NamaKota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NamaKotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NamaKota::truncate();
        $csvFile = fopen(base_path("database/data/regencies.csv"), "r");
        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
        if (!$firstline) {
        NamaKota::create([
        "nama" => $data['0'],
        ]);
        }
        $firstline = false;
        }
        fclose($csvFile);
        }
    
}
