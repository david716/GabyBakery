<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesHasPermissionsSeeder::class);
        $this->call(ModelHasRolesSeeder::class);
        $this->call(WeigthSeeder::class);
        $this->call(DougsSeeder::class);
        $this->call(FillersSeeder::class);
        $this->call(CoveragesSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ExtrasSeeder::class);
        $this->call(EstadosSeeder::class);
        $this->call(ToppersSeeder::class);
        $this->call(ProductShapeSeeder::class);
        $this->call(BlondaShapeSeeder::class);
        $this->call(TypeProductSeeder::class);
        $this->call(ColorsSeeder::class);
        $this->call(SlicesSeeder::class);
        $this->call(EstadoInvoiceSeeder::class);
    }
}
