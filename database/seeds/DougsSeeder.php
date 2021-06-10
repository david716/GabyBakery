<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DougsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dougs = ['Masa de Vainilla', 'Masa de Chocolate', 'Masa de Limón', 'Masa de Naranja', 'Masa de Red Velvet', 'Masa de Vainilla Chips', 'Masa de Maracuyá'];
        $value = [10550, 11708, 12150, 12144, 12206, 12550, 13144];
        for($i = 0; $i < count($dougs); $i++) {
            DB::table('dougs')->insert([
                'flavor'        => $dougs[$i],
                'type'          => $dougs[$i],
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
