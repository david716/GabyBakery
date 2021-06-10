<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $type = ['Estandar', 'Semi Personalizado', 'Personalizado'];
        for($i = 0; $i < count($type); $i++) {
            DB::table('type_products')->insert([
                'name'        => $type[$i],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
}
