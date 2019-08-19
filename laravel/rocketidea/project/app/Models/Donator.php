<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donator extends Model
{
    protected $table = 'donators';

    protected $fillable = [
        'project_id',
        'user_id',
        'pledge_id',
    ];
}
