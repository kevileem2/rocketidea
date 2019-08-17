<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Auth;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function getIndex()
    {
        $news = DB::table('news')->orderBy('created_at', 'desc')->paginate(5);
        $currentUser = Auth::user();
        return view('news.index', compact('news', 'currentUser'));
    }

    public function getCreate(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function postSave()
    {
        $request = request();

        $news_id = ($request->news_id) ? $request->news_id : null;
        $rules = [
            'news_title'         => 'required|max:255' ,
            'news_description'   => 'required' ,
            'news_image'                => 'required',
            'news_image.*'              => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ];
        
        //form validation
        request()->validate($rules);

        //get image path and store images
        $imagePath= "";
        

        if ($request->hasfile('news_image')) {
            $image = $request->file('news_image');
            
            $name=$image->getClientOriginalName();
            //image upload to images folder
            $image->move(public_path().'/images/', $name);
            //image path store in db
            $imagePath =  "../images/" . $request->file('news_image')->getClientOriginalName();
        }

        //news data
        $dataNews = [
            'title' => $request->news_title,
            'description' => $request->news_description,
            'image_path' => $imagePath,
        ];
        News::UpdateOrCreate(['id' => $news_id], $dataNews);

        
        return redirect()->route('news.index');
    }

    public function getEdit($news_id)
    {
        $news = News::find($news_id);
        $user = Auth::user();

        if ($user->role == "admin") {
            return view('news.edit', compact('news'));
        } else {
            return back();
        }
    }


    public function getDetail($news_id)
    {
        $new = News::find($news_id);
        $user = Auth::user();

        return view('news.detail', compact('new', 'user'));
    }

    public function destroy($news_id)
    {
        $news = News::find($news_id);
        
        $news->delete();
        
        return redirect()->route('news.index');
    }
}
