<?php

use App\Models\PrizeCategory;
use Illuminate\Database\Seeder;

class PrizeCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 1,
            'stock' => 100,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 2,
            'stock' => 150,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 3,
            'stock' => 200,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 4,
            'stock' => 250,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 5,
            'stock' => 300,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 1,
            'stock' => 100,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 2,
            'stock' => 150,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 3,
            'stock' => 200,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 4,
            'stock' => 250,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 5,
            'stock' => 300,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 1,
            'stock' => 100,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 2,
            'stock' => 150,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 3,
            'stock' => 200,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 4,
            'stock' => 250,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 5,
            'stock' => 300,
        ]);
    }
}
