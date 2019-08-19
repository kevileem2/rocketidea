<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Categories extends Model
{
    protected $table = "categories";
    protected $fillable = ['name'];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

}
