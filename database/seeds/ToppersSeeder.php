<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToppersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppers = ['Vela de Número', 'Topper Feliz Cumpleaño', 'Topper Happy Birthday', 'Topper Feliz día'];
        $value = [6000, 10000, 10000, 10000];

        for($i = 0; $i < count($toppers); $i++) {
 
            DB::table('toppers')->insert([
                'name'          => $toppers[$i],
                'estado'        => 1,
                'estado_custom' => 0,
                'value'         => $value[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
 
         }
    }
}
