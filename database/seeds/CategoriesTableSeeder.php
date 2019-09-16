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
        Category::create(['name' => 'Oro', 'points_redeem' => 10]);
        Category::create(['name' => 'Plata', 'points_redeem' => 8]);
        Category::create(['name' => 'Bronce alto', 'points_redeem' => 6]);
        Category::create(['name' => 'Bronce medio', 'points_redeem' => 4]);
        Category::create(['name' => 'Bronce bajo', 'points_redeem' => 2]);
    }
}
