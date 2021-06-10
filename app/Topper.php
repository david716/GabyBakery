<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topper extends Model
{
    protected $fillable = [
        'name', 'estado', 'value', 'updated_at'
    ];
}
