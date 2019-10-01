<?php

use App\User;
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
        $user = User::create([
            'active' => true,
            'identification' => '24681',
            'name_company' => 'Admin Corp',
            'email' => 'john.diaz@inxaitcorp.com',
            'password' => bcrypt('R3D3B4N2019*'),
            'category_id' => 2
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'active' => true,
            'identification' => '24682',
            'name_company' => 'User Corp',
            'email' => 'jdiaz2108@hotmail.com',
            'password' => bcrypt('R3D3B4N2019*'),
            'category_id' => 2
        ]);

        $user->assignRole('user');
    }
}
