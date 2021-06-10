<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('product_shape_id');
            $table->integer('product_type_id');
            $table->integer('weight_id');
            $table->integer('slice_id');
            $table->integer('estado_id');
            $table->integer('blonda_id');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('coverage_id');  
            $table->foreign('coverage_id')->references('id')->on('coverages');

            $table->unsignedBigInteger('dough_id')->nullable();
            $table->foreign('dough_id')->references('id')->on('dougs');

            $table->unsignedBigInteger('dough_1_2_id')->nullable();
            $table->foreign('dough_1_2_id')->references('id')->on('dougs');

            $table->unsignedBigInteger('dough_3_4_id')->nullable();
            $table->foreign('dough_3_4_id')->references('id')->on('dougs');

            $table->unsignedBigInteger('filler_id')->nullable();
            $table->foreign('filler_id')->references('id')->on('fillers');

            $table->unsignedBigInteger('filler_1_id')->nullable();
            $table->foreign('filler_1_id')->references('id')->on('fillers');

            $table->unsignedBigInteger('filler_2_id')->nullable();
            $table->foreign('filler_2_id')->references('id')->on('fillers');

            $table->decimal('Libra_1', 10,2)->nullable();
            $table->decimal('Libra_3_4', 10,2)->nullable();
            $table->decimal('Libra_1_2', 10,2)->nullable();
            $table->decimal('Libra_1_4', 10,2)->nullable();
            /*$table->string('message_id')->nullable();
            $table->string('message_color_id')->nullable();*/

            $table->string('images');
            $table->integer('rating');
            $table->string('description')->nullable();
            $table->decimal('sub_value', 12, 2);
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
        Schema::dropIfExists('products');
    }
}
