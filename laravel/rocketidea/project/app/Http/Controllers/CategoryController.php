<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Project;
use App\Models\Project_Image;

class CategoryController extends Controller
{
    public function getIndex(Categories $category)  {
        $projects = Project::where('category_id', $category->id)->get();;
        $categories = Categories::all();
        $images = Project_Image::all();
        return view('projects.index', compact('categories', 'projects', 'images'));
    }
}
