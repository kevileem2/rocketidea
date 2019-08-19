@extends('layout')


@section("title",'Home')

@section('content')

<!-- layer one start -->
@if($projects->isEmpty())
    <div class="alert alert-info" role="alert">
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Oh nee!</h4>
            <p>Er zijn nog geen projecten.<span class='text-bold'></span>.
            <span class='text-bold'> Bekijk een andere category! </span></p>
        </div>
    </div>
@else
<div class="align-items-center ">
    <h3 class="">Best Projects</h3>
</div>
<hr>
<div class="row">
    @foreach($projects as $project)
        @if($project->promotion == 1)
            <div class="col-sm-12 col-md-12 py-2">
                <div class="card" style="width: 100%;">
                    <img src="images/<?php $image_path="";
                    foreach($images as $image){
                        if($image->project_id == $project->id){
                            $image_path = $image->image_path;
                            break;
                        }
                    } print_r($image_path) ?>" style="height:600px;" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$project->title}}</h5>
                        <a href="{{route('projects.detail', $project->id)}}" class="btn primary-button">View Project</a>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
<div class="align-items-center ">
    <h3 class="">Great Projects</h3>
</div>
<hr>
<div class="row">
    @foreach($projects as $project)
    @if($project->promotion == 2)
    <div class="col-sm-12 col-md-6 py-2">
        <div class="card" style="width: 100%;">
            <img src="images/<?php $image_path="";
            foreach($images as $image){
                if($image->project_id == $project->id){
                    $image_path = $image->image_path;
                    break;
                }

            } print_r($image_path) ?>" style="height:300px;" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <a href="{{route('projects.detail', $project->id)}}" class="btn primary-button">View Project</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<div class="align-items-center ">
    <h3 class="">Good Projects</h3>
</div>
<hr>
<div class="row">
    @foreach($projects as $project)
    @if($project->promotion == 3)
    <div class="col-sm-12 col-md-4 py-2">
        <div class="card" style="width: 100%;">
            <img src="
            <?php
            $image_path = "";
            foreach($images as $image) {
                if($image->project_id == $project->id){
                    $image_path = $image->image_path;
                    break;
                }
            }?> {{$image_path}}
            " class="card-img-top" style="height:200px;" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$project->title}}</h5>
                <a href="{{route('projects.detail', $project->id)}}" class="btn btn-primary">View Project</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<!-- layer 3 end -->

@endif
@endsection