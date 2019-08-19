<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Project_Image;

class HomeController extends Controller
{
    public function getIndex(){
        $projects = Project::where('promotion', '!=', 0)->get();
        $images = Project_Image::all();
        return view('homePage')->with(compact('projects', 'images'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

}
