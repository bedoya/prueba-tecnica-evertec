<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Producto 1',
                'price' => 500,
            ],
        ];
        foreach ($products as $product){
            Product::updateOrCreate(['name' => data_get($product, 'name')], $product);
        }
    }
}
