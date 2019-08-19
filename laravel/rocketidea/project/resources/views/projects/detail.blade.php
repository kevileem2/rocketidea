@extends('layout')


@section("title",'Project')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-9">
            <h1>{{$project->title}}</h1>
        </div>
        <div class="col-3 align-self-center actions">
            @if(Auth::check())
            @if($project->user_id == $user->id || $user->role == 'admin' )
            <a href="{{route('projects.edit', $project->id)}}"><button class="btn primary-button" type="submit"><i class="far fa-trash-alt"></i>Edit Project</button></a>
            <a href="{{route('projects.delete', $project->id)}}"><button class="btn btn-danger" type="submit"><i class="far fa-edit"></i>Delete </button></a>
            @endif
            @endif
        </div>
    </div>
</div>
@if (Session::has('message'))
<div class="alert alert-danger">{{ Session::get('message') }}</div>
@endif
<div id="carouselExampleIndicators" class="carousel slide" style="width: 100%; height:500px;" data-ride="carousel">
    <ol class="carousel-indicators">
        @php ($i = 0)
        @foreach($images as $image)

        <li data-target="#carouselExampleIndicators" data-slide-to={{$i}} class="active"></li>
        @php ($i += 1)
        @endforeach
        <li data-target="#carouselExampleIndicators" data-slide-to={{$i}} class="active"></li>
    </ol>
    <div class="carousel-inner" style="height:500px;">
        <div class="carousel-item active">
            <img style="height:500px;"class="d-block w-100 slide-image" src="../../images/blur.png" alt="First slide">
        </div>
        @foreach($images as $image)
        <div class="carousel-item">
            <img style="height:500px;" class="d-block slide-image" src="../../images/{{$image->image_path}}" alt="First slide">
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div>
    <div>
        <h4>Goal: {{$project->target_amount}} RP's</h4>
    </div>
    <div>
        <h5>End Date: {{$project->end_date}}</h5>
    </div>
</div>

<div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: {{$funded_perc}}%"
        aria-valuenow="{{$funded_perc}}" aria-valuemin="0" aria-valuemax="100">{{$funded_perc}}%</div>
    <div class="progress-bar bg-error" role="progressbar" style="width: {{$not_funded_perc}}%"
        aria-valuenow="{{$not_funded_perc}}" aria-valuemin="0" aria-valuemax="100">{{$not_funded_perc}}%</div>
</div>
<div class="pledges-container">

    @if (Session::has('message'))
    <div class="alert alert-danger">{{ Session::get('message') }}</div>
    @endif
    <div class="card-deck mb-3 text-center">
        @foreach($pledges as $pledge)
        <div class="card mb-4 box-shadow">
            <form action="{{route('donators.save')}}" method="post">
                @csrf
                <input type="hidden" name="pledge_id" value="{{ $pledge->id }}" />
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
                <input type="hidden" name="project_user_id" value="{{ $project->user_id }}" />
                @if(Auth::check())
                <input type="hidden" name="user_id" value="{{ $user->id }}" />
                @endif
                <div class="card-header {{$pledge->slug}}">
                    <h4 class="my-0 font-weight-normal">{{$pledge->title}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{$pledge->price}} RP's</h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>{{$pledge->description}}</li>
                    </ul>
                    @if(Auth::check())
                    @if($project->user_id == $user->id)
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="alert alert-danger">Je kan niet op je eigen project doneren!</li>
                    </ul>
                    @endif
                    @if($project->user_id == $user->id)
                    <button type="submit" class="btn btn-lg btn-block inverse-primary-button" disabled>Doneer!</button>
                    @else
                    <button type="submit" class="btn btn-lg btn-block inverse-primary-button">Doneer!</button>
                    @endif

                    @else
                    <ul class="list-unstyled mt-3 mb-4">
                        <li class="alert alert-info">Login om dit project te steunen!</li>
                    </ul>
                    <button type="submit" class="btn btn-lg btn-block btn-outline-secondary" disabled>Doneer!</button>
                    @endif
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
<div class="container">
    <h2>Description</h2>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <p> {!!$project->description!!}</p>
        </div>
    </div>
</div>
<div class="container">
    <h2>Our Donators</h2>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount Of RP's </th>

                </tr>
            </thead>
            <tbody>
                @php ($i = 1)
                @foreach($donators as $donator)
                @if($donator->project_id == $project->id)
                <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$donator->name}}</td>
                    <td>{{$donator->price}}</td>
                </tr>
                @php ($i += 1)
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <h2>Comments</h2>
    @if(Auth::check())
    <form action="{{ route('comments.save') }}" method="post" style="width:100%;">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}" />

        <div class="form-group">
            <label for="Textarea1">Message</label>
            <textarea
                class="form-control {{$errors->any() ? $errors->has('message') ? 'is-invalid': 'is-valid' : ''}} col-sm-12 col-md-8"
                rows="4" maxlength="400" name="message"> {{old('message',$comment->message) }}</textarea>

            @if ($errors->has('message'))
            <div class="invalid-feedback">
                Geef ons geldige commentaar!
            </div>
            @else
            <div class="valid-feedback">
                Super!
            </div>
            @endif
        </div>

        <button class="btn primary-button" type="submit">Verzenden!</button>
    </form>
    @endif
    <div class="comment row">
        <div class="col-sm-12 col-md-8 mt-3">
            @foreach($comments as $comment)
            <div class="card">
                <div class="o-card-horizontal">
                    <div class="card-body bg-g-teal">
                        <h6 class="card-title ">{{$comment->name}}</h6>
                        <p class="card-text">"{{$comment->message}}"</p>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$comment->created_at}}</small>
                </div>
            </div>
            <br>
            @endforeach
            {{$comments->links()}}
        </div>

    </div>
</div>
@endsection