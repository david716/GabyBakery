<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoveragesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coverages = [
            'Cubierta de Arequipe', 'Cubierta de Arequipe de Cafe', 'Cubierta de Chantilli', 'Cubierta de Chocolate',
            'Cubierta de Crema de Queso', 'Cubierta de Crema de Mantequilla', 'Cubierta de Merengue Suizo',
            'Cubierta de Ganache de Chocolate Blanco', 'Cubierta de Ganache de Chocolate Negro', 
        ];
        $value = [4600, 6000, 3000, 4190, 6644, 8000, 2600, 8000, 8000];
        for($i = 0; $i < count($coverages); $i++) {
            DB::table('coverages')->insert([
                'flavor'        => $coverages[$i],
                'type'          => $coverages[$i],
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

        DB::table('coverages')->insert([
            'flavor'        => 'Cubierta de Fondant',
            'type'          => 'Cubierta de Fondant',
            'Libra_1'       => 60000, 
            'Libra_3_4'     => 60000, 
            'Libra_1_2'     => 50000, 
            'Libra_1_4'     => 35000,
            'estado'        => 1,
            'estado_custom' => 0,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);
    }
}
