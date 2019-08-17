<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pledges extends Model
{
    protected $table = 'pledges';
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'description',
        'price',
        'slug',
    ];
}
