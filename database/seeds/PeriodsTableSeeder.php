<?php

use Illuminate\Database\Seeder;
use App\Models\Period;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Period::create([
            'name' => 'Fase 1',
            'initial_date' => '2019-07-01',
            'final_date' => '2019-09-30',
        ]);
        Period::create([
            'name' => 'Fase 2',
            'initial_date' => '2019-08-01',
            'final_date' => '2019-10-30',
        ]);
        Period::create([
            'name' => 'Fase 3',
            'initial_date' => '2019-11-01',
            'final_date' => '2020-01-30',
        ]);
    }
}
