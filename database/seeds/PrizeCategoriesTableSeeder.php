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
            'category_id' => 2,
            'stock' => 21,
            'point' => 566,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 3,
            'stock' => 51,
            'point' => 168,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 4,
            'stock' => 176,
            'point' => 104,
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 5,
            'stock' => 86,
            'point' => 138,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 2,
            'stock' => 12,
            'point' => 943,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 3,
            'stock' => 30,
            'point' => 280,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 4,
            'stock' => 105,
            'point' => 169,
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 5,
            'stock' => 52,
            'point' => 228,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 2,
            'stock' => 8,
            'point' => 1113,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 3,
            'stock' => 20,
            'point' => 328,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 4,
            'stock' => 70,
            'point' => 208,
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 5,
            'stock' => 35,
            'point' => 270,
        ]);

        PrizeCategory::create([
            'prize_id' => 4,
            'category_id' => 2,
            'stock' => 1,
            'point' => 1320,
        ]);

        PrizeCategory::create([
            'prize_id' => 4,
            'category_id' => 3,
            'stock' => 4,
            'point' => 328,
        ]);

        PrizeCategory::create([
            'prize_id' => 4,
            'category_id' => 4,
            'stock' => 12,
            'point' => 247,
        ]);

        PrizeCategory::create([
            'prize_id' => 4,
            'category_id' => 5,
            'stock' => 6,
            'point' => 324,
        ]);

        PrizeCategory::create([
            'prize_id' => 5,
            'category_id' => 2,
            'stock' => 1,
            'point' => 1886,
        ]);

        PrizeCategory::create([
            'prize_id' => 5,
            'category_id' => 3,
            'stock' => 3,
            'point' => 556,
        ]);

        PrizeCategory::create([
            'prize_id' => 5,
            'category_id' => 4,
            'stock' => 9,
            'point' => 351,
        ]);

        PrizeCategory::create([
            'prize_id' => 5,
            'category_id' => 5,
            'stock' => 4,
            'point' => 462,
        ]);

        PrizeCategory::create([
            'prize_id' => 6,
            'category_id' => 2,
            'stock' => 1,
            'point' => 2640,
        ]);

        PrizeCategory::create([
            'prize_id' => 6,
            'category_id' => 3,
            'stock' => 3,
            'point' => 780,
        ]);

        PrizeCategory::create([
            'prize_id' => 6,
            'category_id' => 4,
            'stock' => 9,
            'point' => 481,
        ]);

        PrizeCategory::create([
            'prize_id' => 6,
            'category_id' => 5,
            'stock' => 4,
            'point' => 642,
        ]);

    }
}
