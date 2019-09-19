<?php

use Illuminate\Database\Seeder;
use App\Models\Prize;

class PrizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Prize::create([
            'name' => 'Prize 1',
            'point' => 15,
            'description' => 'Description prize 1',
            'code' => 1111,
        ]);

        Prize::create([
            'name' => 'Prize 2',
            'point' => 20,
            'description' => 'Description prize 2',
            'code' => 2222,
        ]);

        Prize::create([
            'name' => 'Prize 3',
            'point' => 30,
            'description' => 'Description prize 3',
            'code' => 3333,
        ]);
    }
}
