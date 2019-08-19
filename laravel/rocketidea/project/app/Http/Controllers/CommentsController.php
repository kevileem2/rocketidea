<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Project;
use App\Models\User;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function postComment() {
        $project_id = (request('project_id')) ? request('project_id') : null;
        $user_id = Auth::user()->id;
        $rules = [
            'message' => 'required|max:400',
        ];
        $message = request('message');
        $newComment = [
            'user_id' => $user_id,
            'project_id' => $project_id,
            'message' => $message,
        ];
        Comments::Create($newComment);
        return back();
    }
}
