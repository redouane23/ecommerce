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

        $products = ['tomate', 'apple', 'onion', 'watermelon', 'bread', 'egg'];

        for ($i = 1; $i <= 2; $i++) {
            foreach ($products as $product) {

                \App\Product::create([
                    'category_id' => 1,
                    'supplier_id' => 1,
                    'name' => $product . '_' . $i,
                    'description' => $product . ' desc',
                    'purchase_price' => 5000,
                    'sale_price' => 10000,
                    'stock' => 10,
                ]);
            }
        }


    }
}
