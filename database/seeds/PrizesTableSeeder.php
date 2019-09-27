<?php

use Illuminate\Database\Seeder;
use App\Models\Prize;
use Illuminate\Support\Str;

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
            'name' => 'Bono Netflix',
            'description' => 'Bono Netflix $30.000',
            'code' => Str::random(16),
        ]);

        Prize::create([
            'name' => 'Bono Adidas',
            'description' => 'Bono Adidas $50.000',
            'code' => Str::random(16),
        ]);

        Prize::create([
            'name' => 'Licuadora Personal Hamilton Beach',
            'description' => 'Modelo: 51101B.
            Marca: Hamilton Beach
            Capacidad: 1.4 lt.
            Material: Acero Inoxidable.
            Color: Negro/Plateado.
            Potencia: 175W.
            Función pulso: Sí.
            Material cuchillas: Acero Inoxidable.
            Peso: 1.4 kg.
            Número de velocidades: 1.
            Lavavajilla: Apto.
            Garantía: 3 años.
            ',
            'code' => Str::random(16),
        ]);

        Prize::create([
            'name' => 'Wafflera Holstein',
            'description' => 'Modelo: H-09125005B.
            Marca: Holstein
            Capacidad: 1 Waffle.
            Material: Antiadherente.
            Peso: 2.20 kg.
            Número de velocidades: 1.
            Lavavajilla: Apto.
            Garantía: 6 Meses.
            ',
            'code' => Str::random(16),
        ]);

        Prize::create([
            'name' => 'Bono Crepes',
            'description' => 'Bono Crepes $100.000',
            'code' => Str::random(16),
        ]);

        Prize::create([
            'name' => 'Grill',
            'description' => 'Modelo CKSTPA2880-013.
            Con altura ajustable.
            Capacidad para 4 rebanadas.
            Tiene luz indicadora de encendido.
            Almacenamiento vertical con cierre de seguridad.
            Práctica área para enrollar el cable.
            Fabricado en acero inoxidable resistente.
            Garantía de 1 año.
            ',
            'code' => Str::random(16),
        ]);
    }
}
