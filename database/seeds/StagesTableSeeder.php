<?php

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stage::create([
            'name' => 'Fase 1',
            'initial_date' => '2019-07-01',
            'final_date' => '2019-09-30',
            'max_redem_date' => '2019-10-31',
            'state' => 0
        ]);
        Stage::create([
            'name' => 'Fase 2',
            'initial_date' => '2019-08-01',
            'final_date' => '2019-10-30',
            'max_redem_date' => '2019-11-19',
            'state' => 1
        ]);
        Stage::create([
            'name' => 'Fase 3',
            'initial_date' => '2019-11-01',
            'final_date' => '2020-01-30',
            'max_redem_date' => '2020-02-19',
            'state' => 1
        ]);
    }
}
