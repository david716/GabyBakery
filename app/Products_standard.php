<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_standard extends Model
{
    protected $fillable = [
        'product_name',
        'product_shape_id',
        'product_type_id',
        'weight_id', 
        'slices', 
        'blonda_id', 
        'category_id',
        'coverage',
        'dough',
        'dough_1_2',
        'dough_3_4',
        'filler',
        'filler_1',
        'filler_2',
        'images', 
        'rating',
        'description',
        'total_value'
    ];
}
