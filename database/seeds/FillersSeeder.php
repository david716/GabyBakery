<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FillersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fillers = [
            'Relleno de Arequipe', 'Relleno de Arequipe de Cafe', 'Relleno de Chocolate', 'Relleno de Crema de Queso', 
            'Relleno de Mermelada de Fresa', 'Relleno de Mermelada de Mora', 'Relleno de Crema Pastelera',
            'Relleno de Ganache de Chocolate Blanco', 'Relleno de Ganache de Chocolate Negro', 'Relleno de Crema de Mantequilla'
        ];
        $value = [2500, 3000, 1400, 1662, 3000, 3000, 3600, 4000, 4000, 4000];
        for($i = 0; $i < count($fillers); $i++) {
            DB::table('fillers')->insert([
                'flavor'        => $fillers[$i],
                'type'          => $fillers[$i],
                'Libra_1'       => ($value[$i]*4), 
                'Libra_3_4'     => ($value[$i]*3), 
                'Libra_1_2'     => ($value[$i]*2), 
                'Libra_1_4'     => ($value[$i]),
                'estado'        => 1,
                'estado_custom' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
