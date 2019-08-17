<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project_Image extends Model
{
    protected $table = 'project_images';

    protected $fillable = [
        "project_id",
        "cover",
        "image_path",
    ];
}
