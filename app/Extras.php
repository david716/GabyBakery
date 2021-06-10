<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extras extends Model
{
    protected $fillable = [
        'weigth', 'blonda', 'box', 'sticker', 'updated_at'
    ];
}
