@extends('layout')

@section('title', 'News')

@section('content')
@if(Auth::check() && $currentUser->role == "admin")
    <a href="{{route('news.create')}}"><button class="btn btn-primary" type="submit">New News</button></a>
@endif

@if($news->isEmpty())

<div class="alert alert-info" role="alert">
    <h4 class="alert-heading">Oh Dear!</h4>
    <p>Son, nothing to see here! <span class='text-bold'></span>.
        <span class='text-bold'> No News Here, Come back later </span></p>
    <hr>
    <p class="mb-0">Shall we explore some innovative projects?</p>
    <br>
    <!--<a href=""><button class="btn btn-success" type="submit">Explore
            Innovations</button></a>-->

</div>
@else
<div class="row">
    <div class="col-12 mt-3">
        @foreach($news as $new)

        <a href="{{route('news.detail', $new->id)}}">
            <div class="card">
                <div class="o-card-horizontal">
                    <div class="img-square-wrapper">
                        <img class="" src="{{$new->image_path}}" alt="Card image cap">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$new->title}}</h4>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$new->created_at}}</small>
                </div>
            </div>
        </a>
        <br>
        @endforeach

        {{$news->links()}}
    </div>
</div>
@endif

@endsection