@extends('layout')

@section('title', 'News')

@section('content')

<div class="container">
    <div class="row justify-content-between">
        <div class="col-2">
            <h1>News</h1>
        </div>
        <div class="align-self-center">
            @if(Auth::check() && $currentUser->role == "admin")
            <a href="{{route('news.create')}}"><button class="btn primary-button" type="submit"><span class="fa fa-plus"></span> News</button></a>
            @endif
        </div>
    </div>
</div>

@if($news->isEmpty())
    <div class="container">
        <div class="row">
            <div class="alert alert-info col-12" role="alert">
                <h4 class="alert-heading">Geen nieuws hier!</h4>
                <hr>
                <p>Spijtig genoeg hebben we nog geen nieuws voor u!<br>
                <span class='text-bold'>Kom later nog eens terug als we nieuws hebben voor jou! </span></p>
            </div>
        </div>
    </div>
@else
<div class="container">
    <div class="row">
        @foreach($news as $new)
        <a style="width:100%" href="{{route('news.detail', $new->id)}}">
            <div class="news-container col-12">
                <div class="row">
                    <div class="col-2">
                        <img class="img-container" src="{{$new->image_path}}" alt="News Image">
                    </div>
                    <div class="col-10">
                        <h4 class="align-self-top" style="display:inline-block;">{{$new->title}}</h4>
                        @if(strlen($new->description) > 100)
                            <p>{{substr($new->description, 0, 600)}} ...</p>
                        @else
                            <p>{{$new->description}}</p>
                        @endif
                        <br>
                    </div>
                    <div class="col-12 card-footer">
                        <small class="text-muted">{{$new->created_at}}</small>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
        {{$news->links()}}
        </div>
    </div>
</div>
@endif

@endsection