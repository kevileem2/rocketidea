<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shop';
    protected $fillable = [
        'type',
        'total',
        'real_cost_euro',
    ];
}
