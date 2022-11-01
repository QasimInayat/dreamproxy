<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = 'Dedicated Mobile 4G / LTE Proxies';
        $product->price = 89;
        $product->duration_quantity = 1;
        $product->duration_type = 'MONTH';
        $product->status = 'ACTIVE';
        $product->save();

        $product = new Product();
        $product->name = 'Dedicated Mobile 4G / LTE Proxies';
        $product->price = 9.90;
        $product->duration_quantity = 72;
        $product->duration_type = 'HOURS';
        $product->status = 'ACTIVE';
        $product->save();
    }
}
