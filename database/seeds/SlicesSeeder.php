<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slice = ['25 a 32', '24 a 26', '15 a 18', '8 a 10'];
        $weigths = [1, 2, 3, 4];
        for($i = 0; $i < count($slice); $i++) {
            DB::table('slices')->insert([
                'name'        => $slice[$i],
                'weigth'      => $weigths[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
