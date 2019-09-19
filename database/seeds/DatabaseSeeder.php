<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(PeriodsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(ShopsTableSeeder::class);

        $this->call(PrizesTableSeeder::class);
        $this->call(PrizeCategoriesTableSeeder::class);
    }
}
