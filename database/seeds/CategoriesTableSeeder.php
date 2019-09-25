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
        Category::create([
            'name' => 'Oro',
            'points_redeem' => 1,
            'points_update_data' => 1,
            'points_trivia' => 1
            ]);
        Category::create([
            'name' => 'Plata',
            'points_redeem' => 5,
            'points_update_data' => 200,
            'points_trivia' => 350
            ]);
        Category::create([
            'name' => 'Bronce alto',
            'points_redeem' => 15,
            'points_update_data' => 80,
            'points_trivia' => 90
            ]);
        Category::create([
            'name' => 'Bronce medio',
            'points_redeem' => 25,
            'points_update_data' => 50,
            'points_trivia' => 60
            ]);
        Category::create([
            'name' => 'Bronce bajo',
            'points_redeem' => 40,
            'points_update_data' => 60,
            'points_trivia' => 65
            ]);
    }
}
