<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = ['foods', 'clothing'];

        foreach ($categories as $category) {

            \App\Category::create([
                'name' => $category,
            ]);
        }

    }
}
