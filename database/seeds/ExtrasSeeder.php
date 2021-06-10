<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtrasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weigths = [1, 2, 3, 4];
        $blonda  = [2800, 5100, 2600, 2600];
        $box     = [2400, 2200, 2200, 2000];
        $sticker = [300, 300, 300, 300];

        DB::table('extras')->insert([
            [
                'weigth'      => $weigths[0],
                'blonda'      => $blonda[0],
                'box'         => $box[0], 
                'sticker'   => $sticker[0], 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'weigth'      => $weigths[1],
                'blonda'      => $blonda[1],
                'box'         => $box[1], 
                'sticker'   => $sticker[1], 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'weigth'      => $weigths[2],
                'blonda'      => $blonda[2],
                'box'         => $box[2], 
                'sticker'   => $sticker[2], 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'weigth'      => $weigths[3],
                'blonda'      => $blonda[3],
                'box'         => $box[3], 
                'sticker'   => $sticker[3], 
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]
        ]);
    }
}
