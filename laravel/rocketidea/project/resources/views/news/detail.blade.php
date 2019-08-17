@extends('layout')


@section("title",'Project')

@section('content')
<div class="o-project_title">
    <div style="width: 80%;">
        <h1>{{$new->title}}</h1>
    </div>
    @if( Auth::check() && $user->role == "admin")
    <a href="{{route('news.delete', $new->id)}}">
        <button class="btn btn-danger" type="submit">Delete</button>
    </a>
    <a href="{{route('news.edit', $new->id)}}">
        <button class="btn btn-primary" type="submit">Edit News</button>
    </a>
    @endif
</div>
<!-- Project Information -->
<div class="container">
    <!-- images  -->
    <div class="">
        <img class="d-block w-100 slide-image" src="../{{$new->image_path}}" alt="First slide">
    </div>
    <!-- images end -->
    <h2>Description</h2>
    <hr class="featurette-divider">
    <div class="row featurette">

        <div class="col-md-12">
            <p> {!!$new->description!!}</p>
        </div>

    </div>
</div>
<!-- Project Information End -->
@endsection