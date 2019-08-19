@extends('layout')
@section("title",'Project:Confirmed')
@section('content')

<h1>{{$project->title}}</h1>
<!-- Pledges card info -->
<div class="pledges-container">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
            <div class="card-header {{$pledge->slug}}">
                <h4 class="my-0 font-weight-normal">{{$pledge->title}}</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">$ {{$pledge->price}}</h1>
            </div>
        </div>

    </div>
</div>

<div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Dear {{$user->name}}!</h4>
    <p>Aww yeah, you successfully funded project <span class='text-bold'>{{$project->title}}</span>. Now you have
        <span class='text-bold'>{{$user->credits}} </span>RP's.</p>
    <hr>
    <p class="mb-0">Shall we fund some other innovative projects?</p>
    <br>
    <a href="{{route('projects.index')}}"><button class="btn btn-success" type="submit">Explore Innovations</button></a>

</div>

<!-- Pledges card info END-->
<!-- Project Information -->
<!-- Project Information End -->
@endsection