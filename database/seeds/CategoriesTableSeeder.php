<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Oro']);
        Category::create(['name' => 'Plata']);
        Category::create(['name' => 'Bronce alto']);
        Category::create(['name' => 'Bronce medio']);
        Category::create(['name' => 'Bronce bajo']);
    }
}
