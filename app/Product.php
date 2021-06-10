<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'product_shape_id',
        'product_type_id',
        'weight_id', 
        'slice_id',
        'estado_id',
        'blonda_id', 
        'category_id',
        'coverage_id',
        'dough_id',
        'dough_1_2_id',
        'dough_3_4_id',
        'filler_id',
        'filler_1_id',
        'filler_2_id',
        'Libra_1',
        'Libra_3_4',
        'Libra_1_2',
        'Libra_1_4',
        'images', 
        'rating',
        'description',
        'sub_value',
        'total_value'
    ];

    public function category()
    {
        return $this->hasMany('App\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function coverages()
    {

        return $this->hasOne('App\Coverage');

    }

    public function decorations()
    {

        return $this->hasMany('App\Decoration');

    }

    public function dougs()
    {

        return $this->belongsToMany('App\Doug', 'products_dougs');

    }

    public function fillers()
    {

        return $this->belongsToMany('App\Filler', 'fillers_products');

    }

    public function invoice() {
        return $this->belongsToMany('App\Invoice', 'invoices_products');
    }

    // public function toppers()
    // {

    //     return $this->hasMany('App\Topper');

    // }

    // public function toppings()
    // {

    //     return $this->hasMany('App\Topping');

    // }

}
