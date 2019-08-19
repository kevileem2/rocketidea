@extends('layout')


@section("title",'Shop')

@section('content')
<div class="container">
    <div class="row">
        <h1>Shop</h1>
        <div class="confirmed-container alert alert-success col-12" role="alert">
            <h4 class="alert-heading">Hoera!</h4>
            <p>
                Je hebt succesvol <span class='text-bold'>{{$total}}</span> RP's gekocht! <br>
                Nu heb je <span class='text-bold'>{{$total_user_RP}} </span>RP's!
            </p>
            <hr>
            <p>Wil je uw nieuwe aangekochte credits spenderen aan toffe projecten?!</p>
            <br>
        <a href="{{route('projects.index')}}"><button class="btn primary-button">Bekijk projecten hier!</button></a>
        </div>
    </div>
</div>
@endsection