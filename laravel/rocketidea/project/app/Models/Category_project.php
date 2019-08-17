<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category_project extends Model
{
    protected $table = 'category_project';
    protected $fillable = [
       "project_id",
       "category_id",
    ];
}
