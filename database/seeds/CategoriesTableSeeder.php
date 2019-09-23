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
        Category::create(['name' => 'Oro', 'points_redeem' => 1]);
        Category::create(['name' => 'Plata', 'points_redeem' => 5]);
        Category::create(['name' => 'Bronce alto', 'points_redeem' => 15]);
        Category::create(['name' => 'Bronce medio', 'points_redeem' => 25]);
        Category::create(['name' => 'Bronce bajo', 'points_redeem' => 40]);
    }
}
