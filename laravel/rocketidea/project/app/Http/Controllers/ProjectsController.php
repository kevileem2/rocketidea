<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\User;
use App\Models\Pledges;
use App\Models\Project_Image;
use App\Models\Categories;
use App\Models\Category_project;
use App\Models\Comments;

use Auth;
use Session;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    public function getIndex(Categories $category = null) {
        if($category !== null) {
            $categories = Categories::all()->sortBy($category);
        } else {
            $categories = Categories::all()->sortBy("name");
        }
        
        $images = Project_Image::all();
        $projects = Project::all();

        //check for outdated promotion
        foreach ($projects as $project) {
            if ($project->promotion_start_date != null) {
                $promotion_end_date = strtotime("+1 week", strtotime($project->promotion_start_date));
                $currentDate =  strtotime(date("Y-m-d"));
                if ($currentDate > $promotion_end_date) {
                    $project->promotion_start_date = null;
                    $project->save();
                }
            }
        }
        
        return view('projects.index', compact('projects', 'categories', 'images'));
    }
    public function getMyProjects()
    {
        $user = Auth::user();
        //sortByDesc Z -> A
        //sortBy
        $categories = Categories::all()->sortBy("name");
        $images = Project_Image::all();
        $projects = Project::where('user_id', $user->id)->get();
        
        //check for outdated promotion
        foreach ($projects as $project) {
            if ($project->promotion_start_date != null) {
                $promotion_end_date = strtotime("+1 week", strtotime($project->promotion_start_date));
                $currentDate =  strtotime(date("Y-m-d"));
                if ($currentDate > $promotion_end_date) {
                    $project->promotion_start_date = null;
                    $project->save();
                }
            }
        }
        
        return view('projects.myprojects', compact('projects', 'categories', 'user', 'images'));
    }
    
    public function getCreate(Project $project, Pledges $pledge)
    {
        $user = Auth::user();
        $categories = Categories::all();
        $pledges = [$pledge,$pledge,$pledge];
        return view('projects.edit', compact('user', 'project', 'pledges', 'categories'));
    }


    public function getEdit($project_id)
    {
        $categories = Categories::all();
        $project = Project::find($project_id);
        $pledges = Pledges::where('project_id', $project_id)->get();
      

        $start_date = $project->getStartDateByFormat('Y-m-d');
        $end_date = $project->getEndDateByFormat('Y-m-d');

        return view('projects.edit', compact('project', 'pledges', 'categories'));
    }
    public function getDetail($project_id, Comments $comment)
    {
        $project = Project::find($project_id);
        $images = Project_Image::where('project_id', $project_id)->get();
        $pledgeLegendary = Pledges::where('project_id', $project_id)->where('title', 'Legendary Pledge')->get();
        $pledgeEpic = Pledges::where('project_id', $project_id)->where('title', 'Epic Pledge')->get();
        $pledgeRare = Pledges::where('project_id', $project_id)->where('title', 'Rare Pledge')->get();
        $pledges = Pledges::where('project_id', $project_id)->get();
        $user = Auth::user();

        $comments = DB::table('comments')
        ->where('project_id', $project_id)
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->orderBy('comments.created_at', 'DESC')->paginate(5);
     
        $donators = DB::table('donators')
        ->join('users', 'donators.user_id', '=', 'users.id')
        ->join('pledges', 'donators.pledge_id', '=', 'pledges.id')
        ->get();

        $funded_amount = 0;
        $funded_perc = 0;
        $not_funded_perc = 0;
        foreach($donators as $donator){
            if($donator->project_id == $project_id){
                foreach($pledges as $pledge){
                    if($donator->pledge_id == $pledge->id){
                        $funded_amount += $pledge->price;
                    }
                }
            }
        }

        if ($funded_amount >= 0) {
            $funded_perc = round($funded_amount / $project->target_amount * 100, 2);
            $not_funded_perc = round(100 - $funded_perc, 2);
            if ($not_funded_perc < 0) {
                $not_funded_perc = 0;
            }
        }
        
        return view('projects.detail', compact('funded_perc', 'not_funded_perc', 'comments', 'comment', 'donators', 'user', 'project', 'images', 'pledges', 'pledgeLegendary', 'pledgeEpic', 'pledgeRare'));
    }

    public function postSave()
    {
        $user = Auth::user();
        $project_id = (request("project_id")) ? request('project_id') : null;
        $request = request();

        $rules = [
            'project_title'         => 'required|max:200' ,
            'project_description'   => 'required' ,
            'project_target_amount' => 'required|integer',
            'project_category'      => 'required',
            'start_date'            => 'date_format:"d-m-Y"|required|before_or_equal:end_date',
            'end_date'              => 'date_format:"d-m-Y"|required|after_or_equal:start_date',
            'images'                => 'required',
            'images.*'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'legendary_price'       => 'required|numeric',
            'epic_price'            => 'required|numeric',
            'rare_price'            => 'required|numeric',
            'legendary_info'        => 'required' ,
            'epic_info'             => 'required' ,
            'rare_info'             => 'required' ,
        ];
        request()->validate($rules);

        $dataProject = [
            'user_id'       => $user->id,
            'category_id'   => request('project_category'),
            'title'         => request('project_title'),
            'description'   => request('project_description') ,
            'target_amount' => request('project_target_amount'),
            'start_date'    => request('start_date') ,
            'end_date'      => request('end_date'),
        ];

        $dataProject['start_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['start_date']);
        $dataProject['end_date'] = \DateTime::createFromFormat('d-m-Y', $dataProject['end_date']);
        
        //last added project id
        $lastEditProject = Project::UpdateOrCreate(['id' => $project_id], $dataProject);
        $currentProjectId = $lastEditProject->id;
        
        //images handles
        $data= [];
        
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $image) {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/images/', $name);
                $imagePath =  $name; 
                $projectImageData = [
                    "project_id" => $currentProjectId,
                    "image_path" => $imagePath,
                    "cover" => 0,
                ];
                Project_Image::UpdateOrCreate($projectImageData);
                $data[] = $name;
            }
        }

        // projects and categories relations
        $categoryProject = [
            'project_id'   => $currentProjectId ,
            'category_id'   => request('project_category'),
        ];
        Category_project::UpdateOrCreate(['project_id' => $currentProjectId], $categoryProject);

        //insert pledges for current project
        $l_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Legendarische Donatie",
            'description' => request('legendary_info'),
            'price' => request('legendary_price'),
            'slug' => 'Legendarisch',
        ];

        $e_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Epische Donatie",
            'description' => request('epic_info'),
            'price' => request('epic_price'),
            'slug' => 'Episch',
        ];

        $r_pledge = [
            'project_id' => $currentProjectId,
            'title' => "Zeldzame Donatie",
            'description' => request('rare_info'),
            'price' => request('rare_price'),
            'slug' => 'Zeldzaam',
        ];

        Pledges::UpdateOrCreate(['project_id' => $currentProjectId, 'user_id' => $user->id, 'title' => "Legendarische Donatie"], $l_pledge);
        Pledges::UpdateOrCreate(['project_id' => $currentProjectId, 'user_id' => $user->id, 'title' => "Epische Donatie"], $e_pledge);
        Pledges::UpdateOrCreate(['project_id' => $currentProjectId, 'user_id' => $user->id, 'title' => "Zeldzame Donatie"], $r_pledge);
        return redirect()->route('projects.index');
    }

    public function getPromote($project_id, $promotion_id)
    {
        $currentUser = Auth::user();
        $project = Project::find($project_id);
        $admin = User::where('role', "=", 'admin')->firstOrFail();
        switch ($promotion_id) {
            case 0:
                $project->promotion_start_date = null;
                $project->promotion = 0;
                break;
            case 1:
                if ($currentUser->credits >= 10) {
                    $currentUser->credits = $currentUser->credits - 10;
                    
                    $project->promotion = $promotion_id;
                    $project->promotion_start_date = date("Y-m-d");
                    $admin->credits += 10;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "Je hebt niet genoeg credits!");
                    return Redirect::back();
                }
                break;
            
            case 2:
                if ($currentUser->credits >= 5) {
                    $currentUser->credits = $currentUser->credits - 5;
                    $project->promotion = $promotion_id;
                    $project->promotion_start_date = date("Y-m-d");

                    $admin->credits += 5;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "Je hebt niet genoeg credits!");
                    return Redirect::back();
                }
                break;
            case 3:
                if ($currentUser->credits >= 3) {
                    $currentUser->credits = $currentUser->credits - 3;
                    $project->promotion = $promotion_id;
                    $project->promotion_start_date = date("Y-m-d");

                    $admin->credits += 3;
                    $admin->save();
                    $currentUser->save();
                } else {
                    Session::flash('message', "Je hebt niet genoeg credits!");
                    return Redirect::back();
                }
                break;
            default:
                break;
        }

        $project->save();
        return redirect()->route('homePage');
    }

    public function destroy($project_id)
    {
        $project = Project::find($project_id);
        $currentUser = User::find($project->user_id);
        //all f's earn goes to account
        $currentUser->credits += $project->funded_amount;
        $currentUser->save();
        

        $project->delete();
     
        return redirect()->route('projects.index');
    }
}
