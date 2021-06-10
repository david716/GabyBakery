<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fillers', function (Blueprint $table) {
            $table->id();
            $table->string('flavor');
            $table->string('type');
            $table->decimal('Libra_1', 10, 2)->nullable();
            $table->decimal('Libra_3_4', 10, 2)->nullable();
            $table->decimal('Libra_1_2', 10, 2)->nullable();
            $table->decimal('Libra_1_4', 10, 2)->nullable();
            $table->integer('estado');
            $table->integer('estado_custom');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fillers');
    }
}
