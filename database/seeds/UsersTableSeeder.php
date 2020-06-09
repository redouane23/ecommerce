<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'super_admin@app.com',
            'image' => 'default.png',
            'password' => bcrypt('123456')
        ]);

        $user->attachRole('super_admin');

        $user->carts()->create([]);

        $user = \App\User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@app.com',
            'image' => 'default.png',
            'password' => bcrypt('admin')
        ]);

        $user->attachRole('super_admin');
        $user->attachRole('admin');

        $user->carts()->create([]);

        $user = \App\User::create([
            'first_name' => 'client',
            'last_name' => 'client',
            'email' => 'client@app.com',
            'image' => 'default.png',
            'password' => bcrypt('client')
        ]);

        $user->attachRole('client');

        $user->carts()->create([]);

    }//end of run

}//end of seeder
