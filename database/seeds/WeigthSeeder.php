<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WeigthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weigths = ['1 Libra', '3/4 Libra', '1/2 Libra', '1/4 Libra'];
 
         for($i = 0; $i < count($weigths); $i++) {
 
            DB::table('weigths')->insert([
                'name'          => $weigths[$i],
                'estado'        => 1,
                'estado_custom' => 0,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
 
         }
    }
}
