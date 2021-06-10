<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdcutCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodcut_customs', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_shape_id');
            $table->integer('product_type_id');
            $table->string('weight_id');
            $table->integer('slice_id')->nullable();
            $table->integer('blonda_id')->nullable();
            $table->integer('blonda_color')->nullable();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

            $table->integer('coverage');  

            $table->integer('dough')->nullable();

            $table->integer('dough_1_2')->nullable();

            $table->integer('dough_3_4')->nullable();

            $table->integer('filler')->nullable();

            $table->integer('filler_1')->nullable();

            $table->integer('filler_2')->nullable();


            $table->string('edge')->nullable();
            $table->integer('egde_flavor')->nullable();
            $table->integer('topper')->nullable();
            $table->integer('topper_value')->nullable();
            $table->integer('topper_color')->nullable();
            $table->string('message')->nullable();
            $table->integer('message_color')->nullable();

            $table->string('images')->nullable();
            $table->integer('rating')->nullable();
            $table->string('description')->nullable();
           // $table->decimal('sub_value', 12, 2);
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
        Schema::dropIfExists('prodcut_customs');
    }
}
