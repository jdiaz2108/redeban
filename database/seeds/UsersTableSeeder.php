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
            'identification' => '123456789',
            'name_company' => 'Admin Corp',
            'email' => 'john.diaz@inxaitcorp.com',
            'password' => bcrypt('123456789'),
            'category_id' => 1
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'active' => true,
            'identification' => '123456',
            'name_company' => 'User Corp',
            'email' => 'jdiaz2108@hotmail.com',
            'password' => bcrypt('123456'),
            'category_id' => 1
        ]);

        $user->assignRole('user');
    }
}
