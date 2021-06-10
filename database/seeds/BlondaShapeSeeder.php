<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlondaShapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blonda = ['Cuadrado', 'Redondo'];
        for($i = 0; $i < count($blonda); $i++) {
            DB::table('blonda_shapes')->insert([
                'name'        => $blonda[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
