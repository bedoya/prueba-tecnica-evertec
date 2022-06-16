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
                'price' => 50000,
                'data' => [
                    'excerpt' => 'Esta es la descripción corta del producto 1',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer lacinia mi turpis, in elementum velit cursus at. Proin massa enim, tristique at sem sit amet, tempor ultrices tortor. Nulla egestas nulla at nisl consectetur consectetur. Fusce at elit a sem condimentum dictum eget quis justo. Maecenas scelerisque consectetur viverra. Integer est leo, ultricies a consequat vitae, tincidunt et odio. Phasellus facilisis commodo velit, tristique porta mauris euismod id. Maecenas sed iaculis quam.',
                ],
            ],
        ];
        foreach ($products as $product){
            Product::updateOrCreate(['name' => data_get($product, 'name')], $product);
        }
    }
}
