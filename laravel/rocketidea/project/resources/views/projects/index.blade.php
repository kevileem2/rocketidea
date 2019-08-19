@extends('layout')


@section("title",'Projects')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-6">
            <h1>Alle inzamel acties!</h1>
        </div>
        @if(Auth::check())
        <div class="align-self-center">
            <a href="{{route('projects.create')}}"><button class="btn primary-button" type="submit"><span class="fa fa-plus"></span>  New Project</button></a>
            <div class="btn-group">
                <button type="button" class="btn primary-button dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Category
                </button>
                <div class="dropdown-menu">
                    @foreach($categories as $category)
                    <a class="dropdown-item"
                        href="{{route('categories.index', $category->name)}}">{{ucfirst($category->name)}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        @else
        <div class="col-6 align-self-center">
            <h6>Heb je een idee of project dat je wil delen met anderen? <a href=" {{route('login')}}"><br><button class="btn primary-button" type="submit">Log in hier!</button></a></h6>
        </div>
        @endif
    </div>
    <hr>
    @if (Session::has('message'))
        <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        @if($projects->isEmpty())
            <div class="alert alert-info" role="alert">
                <h4 class="alert-heading">Oh nee!</h4>
                <p>Er zijn nog geen projecten.<span class='text-bold'></span>.
                <span class='text-bold'> Bekijk een andere category! </span></p>
            </div>
        @endif
            <div class="card-group">
                @foreach($projects as $project)
                <div class="col-sm-6 col-md-4 py-2">
                    <div class="card" style="width: 100%;">
                        <img src="../images/<?php $image_path="";
                        foreach($images as $image){
                            if($image->project_id == $project->id){
                                $image_path = $image->image_path;
                                break;
                            }
                        } print_r($image_path) ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$project->title}}</h5>
                            @if(strlen($project->description) > 100)
                                <p>{{substr($project->description, 0, 200)}} ...</p>
                            @else
                                <p>{{$project->description}}</p>
                            @endif
                            <a href="{{route('projects.detail', $project->id)}}" class="btn primary-button">Bekijk Project!</a>
                            @if(Auth::check() && Auth::user()->id == $project->user_id )
                            <a class=" btn btn-warning dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Promote
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            
                                @if($project->promotion == 0)
                                <a class="dropdown-item bg-g-legendary" href="{{route('projects.promote',[$project->id, 1])}}">To The best promotion: 10 RP's</a>
                                <a class="dropdown-item bg-g-epic" href="{{route('projects.promote',[$project->id, 2])}}">To a good promotion: 5 RP's</a>
                                <a class="dropdown-item bg-g-rare" href="{{route('projects.promote',[$project->id, 3])}}">To a normal promotion: 3 RP's</a>
                                @endif
            
                                @if($project->promotion != 0)
                                <a class="dropdown-item list-group-item-action list-group-item-success disabled"
                                    href="{{route('projects.promote',[$project->id, 3])}}">Current Promotion:
                                    {{$project->promotion}}</a>
                                <a class="dropdown-item list-group-item-action list-group-item-danger"
                                    href="{{route('projects.promote',[$project->id, 0])}}">Stop
                                    Promotion</a>
                                @endif
            
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection