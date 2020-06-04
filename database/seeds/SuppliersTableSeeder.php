<?php

use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $suppliers = ['four 1', 'four 2'];
        $phones = ['111111', '222222'];

        foreach ($suppliers as $supplier) {

            \App\Supplier::create([
                'name' => $supplier,
                'phone' => $phones,
                'address' => 'alger',
            ]);
        }

    }
}
