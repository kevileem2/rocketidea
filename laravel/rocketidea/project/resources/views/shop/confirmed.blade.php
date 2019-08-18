@extends('layout')


@section("title",'Shop')

@section('content')
<div class="container">
    <div class="row">
        <h1>Shop</h1>
        <div class="confirmed-container alert alert-success col-12" role="alert">
            <h4 class="alert-heading">Well done!</h4>
            <p>
                You succesfully purchased <span class='text-bold'>{{$total}}</span> RP's! <br>
                Now you have <span class='text-bold'>{{$total_user_RP}} </span>RP's!
            </p>
            <hr>
            <p>You want to spend your newly added credits? Check out existing projects!</p>
            <br>
            <a href=""><button class="btn primary-button">Check Projects</button></a>
        </div>
    </div>
</div>
@endsection