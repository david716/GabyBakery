<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coverage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'flavor', 'type', 'Libra_1', 'Libra_3_4', 'Libra_1_2', 'Libra_1_4', 'estado', 'updated_at'
    ];

    public function product() 
    {

        return $this->belongsTo('App\Product');

    }

}
