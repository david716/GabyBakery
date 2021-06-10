<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products_invoices extends Model
{
    protected $fillable = [
        'product_id', 
        'invoice_id', 
    ];//
}
