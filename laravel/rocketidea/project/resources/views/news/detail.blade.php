@extends('layout')


@section("title",$new->title)

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-9">
            <h1>{{$new->title}}</h1>
        </div>
        <div class="align-self-center">
            @if(Auth::check() && $user->role == "admin")
            <a href="{{route('news.edit', $new->id)}}">
                <button class="btn primary-button" type="submit"><i class="far fa-edit"></i>  Edit News</button>
            </a>
            <a style="margin-right:10px;"href="{{route('news.delete', $new->id)}}">
                <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i>  Delete</button>
            </a>
            @endif
        </div>
    </div>
</div>
<div class="container">
        <div class="row">
                <div class="news-container col-12">
                    <div class="row">
                        <div class="col-4">
                            <img class="img-container" src="../{{$new->image_path}}" alt="News Image">
                        </div>
                        <div class="col-8" style="margin-top: 20px;">
                            <p>{{$new->description}}</p>
                            <br>
                        </div>
                        <div class="col-12 card-footer">
                            <small class="text-muted">{{$new->created_at}}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection