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
            'name' => 'Admin',
            'email' => 'john.diaz@inxaitcorp.com',
            'password' => bcrypt('123456789'),
            'active' => 1
        ]);

        $user->assignRole('admin');
    }
}
