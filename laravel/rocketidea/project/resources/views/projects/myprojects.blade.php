@extends('layout')


@section("title",'Projects')

@section('content')
<h1>My Projects</h1>
@if (Session::has('message'))
<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif

@foreach($categories as $category)
<h3>{{$category->name}}</h3>
<hr>
<div class="row">
    @foreach($projects as $project)
    @if($project->category_id == $category->id)
    @if($project->user_id == $user->id)
    <div class="col-sm-6 col-md-4 py-2">
        <div class="card" style="width: 100%;">
            <img src="../images/<?php $image_path="";
            foreach($images as $image){
                if($image->project_id == $project->id){
                    $image_path = $image->image_path;
                    break;
                }
            } print_r($image_path) ?>" style="height:200px;" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
                <a class=" btn btn-warning dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Promote
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                    @if($project->promotion == 0)
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 1])}}">To The best promotion: 10 RP's</a>
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 2])}}">To a good promotion: 5 RP's</a>
                    <a class="dropdown-item" href="{{route('projects.promote',[$project->id, 3])}}">To a normal promotion: 3 RP's</a>
                    @endif

                    @if($project->promotion != 0)
                    <a class="dropdown-item list-group-item-action list-group-item-success disabled"
                        href="{{route('projects.promote',[$project->id, 3])}}">Current promotion:
                        {{$project->promotion}}</a>
                    <a class="dropdown-item list-group-item-action list-group-item-danger"
                        href="{{route('projects.promote',[$project->id, 0])}}">Stop
                        Promotion</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
    @endforeach
</div>
@endforeach
@endsection