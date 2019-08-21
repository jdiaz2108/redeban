<?php

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create(['name' => 'Actividad 1']);
        Activity::create(['name' => 'Actividad 2']);
        Activity::create(['name' => 'Actividad 3']);
        Activity::create(['name' => 'Actividad 4']);
    }
}
