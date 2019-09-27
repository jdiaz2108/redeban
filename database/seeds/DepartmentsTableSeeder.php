<?php

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'Amazonas', 'code' => 91]);
        Department::create(['name' => 'Antioquia', 'code' => 5]);
        Department::create(['name' => 'Arauca', 'code' => 81]);
        Department::create(['name' => 'Atlántico', 'code' => 8]);
        Department::create(['name' => 'Bogotá', 'code' => 11]);
        Department::create(['name' => 'Bolívar', 'code' => 13]);
        Department::create(['name' => 'Boyacá', 'code' => 15]);
        Department::create(['name' => 'Caldas', 'code' => 17]);
        Department::create(['name' => 'Caquetá', 'code' => 18]);
        Department::create(['name' => 'Casanare', 'code' => 85]);
        Department::create(['name' => 'Cauca', 'code' => 19]);
        Department::create(['name' => 'Cesar', 'code' => 20]);
        Department::create(['name' => 'Chocó', 'code' => 27]);
        Department::create(['name' => 'Córdoba', 'code' => 23]);
        Department::create(['name' => 'Cundinamarca', 'code' => 25]);
        Department::create(['name' => 'Guainía', 'code' => 94]);
        Department::create(['name' => 'Guaviare', 'code' => 95]);
        Department::create(['name' => 'Huila', 'code' => 41]);
        Department::create(['name' => 'La Guajira', 'code' => 44]);
        Department::create(['name' => 'Magdalena', 'code' => 47]);
        Department::create(['name' => 'Meta', 'code' => 50]);
        Department::create(['name' => 'Nariño', 'code' => 52]);
        Department::create(['name' => 'Norte de Santander', 'code' => 54]);
        Department::create(['name' => 'Putumayo', 'code' => 86]);
        Department::create(['name' => 'Quindío', 'code' => 63]);
        Department::create(['name' => 'Risaralda', 'code' => 66]);
        Department::create(['name' => 'San Andrés y Providencia', 'code' => 88]);
        Department::create(['name' => 'Santander', 'code' => 68]);
        Department::create(['name' => 'Sucre', 'code' => 70]);
        Department::create(['name' => 'Tolima', 'code' => 73]);
        Department::create(['name' => 'Valle del Cauca', 'code' => 76]);
        Department::create(['name' => 'Vaupés', 'code' => 97]);
        Department::create(['name' => 'Vichada', 'code' => 99]);
    }
}
