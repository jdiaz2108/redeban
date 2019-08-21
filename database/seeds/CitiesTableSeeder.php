<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['name' => 'Leticia', 'department_id' => 1]);
        City::create(['name' => 'El encanto', 'department_id' => 1]);
        City::create(['name' => 'La chorrera', 'department_id' => 1]);
        City::create(['name' => 'La pedrera', 'department_id' => 1]);
        City::create(['name' => 'La victoria', 'department_id' => 1]);
        City::create(['name' => 'Miriti - parana', 'department_id' => 1]);
        City::create(['name' => 'Puerto alegria', 'department_id' => 1]);
        City::create(['name' => 'Puerto arica', 'department_id' => 1]);
        City::create(['name' => 'Puerto nariño', 'department_id' => 1]);
        City::create(['name' => 'Puerto santander', 'department_id' => 1]);
        City::create(['name' => 'Tarapaca', 'department_id' => 1]);
    }
}
