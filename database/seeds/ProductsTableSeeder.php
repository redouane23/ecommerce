<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products = ['tomate', 'pomme'];

        foreach ($products as $product) {

            \App\Product::create([
                'category_id' => 1,
                'supplier_id' => 1,
                'name' => $product,
                'description' => $product . ' desc',
                'purchase_price' => 160,
                'sale_price' => 200,
                'stock' => 100,
            ]);
        }

    }
}
