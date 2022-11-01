<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_handle = fopen(storage_path('provinces.csv'), 'r');
        $i = 0;
        while (!feof($file_handle)) {
            $i++;
            $country_csv = fgetcsv($file_handle, 0, ";");
            if($i <= 2 || !$country_csv) continue;

            $province = new Province();
            $province->name = $country_csv[2];
            $province->code = $country_csv[1];
            $province->save();
        }
        fclose($file_handle);
    }
}
