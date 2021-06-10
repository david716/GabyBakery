<?php

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
           'Boda', 
           'Quinceañeros', 
           'Cumpleaños'
        ];

        for($i = 0; $i < count($categories); $i++) {

            DB::table('categories')->insert([
                'name'        => $categories[$i],
                'description' => 'Pudin para ' . $categories[$i],
                'estado'      => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);

        }

    }
}
