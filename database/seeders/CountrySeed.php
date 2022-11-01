<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_handle = fopen(storage_path('countries.csv'), 'r');
        $i = 0;
        while (!feof($file_handle)) {
            $i++;
            $country_csv = fgetcsv($file_handle, 0, ",");
            if($i === 1 || !$country_csv) continue;

            $country = new Country();
            $country->name = $country_csv[0];
            $country->code = $country_csv[1];
            $country->save();
        }
        fclose($file_handle);
    }
}
