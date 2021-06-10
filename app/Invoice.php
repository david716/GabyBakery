<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purchase_date', 
        'delivery_date', 
        'user_id', 
        'purchase_hour',
        'delivery_hour',
        'estado',
        'value',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product() {

        return $this->belongsToMany('App\Product', 'products_invoices');

    }

}
