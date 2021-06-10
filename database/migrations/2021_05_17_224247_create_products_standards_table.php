<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_standards', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('product_shape_id');
            $table->integer('product_type_id');
            $table->integer('weight_id');
            $table->integer('slice_id');
            $table->integer('blonda_id');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('coverage');  

            $table->integer('dough')->nullable();

            $table->integer('dough_1_2')->nullable();

            $table->integer('dough_3_4')->nullable();

            $table->integer('filler')->nullable();

            $table->integer('filler_1')->nullable();

            $table->integer('filler_2')->nullable();

            $table->string('images')->nullable();
            $table->integer('rating');
            $table->string('description')->nullable();
            $table->decimal('total_value', 12, 2);
            
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
        Schema::dropIfExists('products_standards');
    }
}
