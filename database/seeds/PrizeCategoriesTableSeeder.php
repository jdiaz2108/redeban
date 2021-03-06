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
            'category_id' => 4,
            'stock' => 250,
            'point' => 566,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 1,
            'category_id' => 5,
            'stock' => 250,
            'point' => 168,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 4,
            'stock' => 150,
            'point' => 169,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 2,
            'category_id' => 5,
            'stock' => 150,
            'point' => 228,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 3,
            'category_id' => 3,
            'stock' => 200,
            'point' => 328,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 4,
            'category_id' => 3,
            'stock' => 35,
            'point' => 328,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 5,
            'category_id' => 2,
            'stock' => 25,
            'point' => 1886,
            'code' => Str::random(16),
        ]);

        PrizeCategory::create([
            'prize_id' => 6,
            'category_id' => 2,
            'stock' => 25,
            'point' => 2640,
            'code' => Str::random(16),
        ]);

    }
}
