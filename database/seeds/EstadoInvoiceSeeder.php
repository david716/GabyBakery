<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['En proceso', 'Finalizado', 'Cancelado'];

        for($i = 0; $i < count($name); $i++) {
            DB::table('estado_invoices')->insert([
                'name'        => $name[$i],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]);
        }
    }
}
