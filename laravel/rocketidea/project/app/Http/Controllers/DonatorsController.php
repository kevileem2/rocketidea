<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\User;
use App\Models\Pledges;
use App\Models\Project_Image;
use App\Models\Categories;
use App\Models\CategoryProject;
use App\Models\Donator;

use Session;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DonatorsController extends Controller
{
    public function postDonator()
    {
        $project_id = (request("project_id")) ? request('project_id') : null;
        $pledge_id = (request("pledge_id")) ? request('pledge_id') : null;
        $user = Auth::user();
        $admin = User::where('role', '=', 'admin')->firstOrFail();

       
        $project = Project::find($project_id);
        $pledge = Pledges::find($pledge_id);

        if ($user->credits >= $pledge->price) {
            //client credits update
            $total_user_RP = $user->credits - $pledge->price;

            $user->credits = $total_user_RP;
            $user->save();

            //commission add to admin account
            $commission = (int)($pledge->price * 0.1);
            $admin->credits += $commission;
            $admin->save();

            //create a baker
            $newDonator = [
                'project_id' => $project_id,
                'user_id' => $user->id,
                'pledge_id' => $pledge_id,
            ];

            Donator::UpdateOrCreate($newDonator);

            //add fund to project funded f's

            //good page
            return view('projects.donation', compact('project', 'pledge', 'user'));
        } else {
            Session::flash('message', "You hebt niet genoeg credits!");
            return Redirect::back();
        }
    }
}
