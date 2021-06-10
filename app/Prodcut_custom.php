<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodcut_custom extends Model
{
    protected $fillable = [
        'product_name',
        'product_shape',
        'product_type_id',
        'weight', 
        'slices', 
        'blonda', 
        'blonda_color',
        'category_id',
        'coverage',
        'dough',
        'dough_1_2',
        'dough_3_4',
        'filler',
        'filler_1',
        'filler_2',
        'edge',
        'edge_flavor',
        'topper',
        'topper_color',
        'topper_value',
        'message',
        'message_color',
        'images', 
        'rating',
        'description',
        'total_value'
    ];
}
