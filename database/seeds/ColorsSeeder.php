<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Madera', 'Plateado', 'Dorado', 'Rosado'];

        for($i = 0; $i < count($colors); $i++) {
 
            DB::table('colors')->insert([
                'name'          => $colors[$i],
                'estado'        => 1,
                'estado_custom' => (($i == 1 || 2 ) ? 1 : 0),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
 
         }
    }
}
