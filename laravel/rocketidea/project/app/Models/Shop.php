<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop_items';
    protected $fillable = [
        'type',
        'total',
        'cost_in_euro',
    ];
}
