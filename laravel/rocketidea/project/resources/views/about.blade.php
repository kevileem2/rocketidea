@extends('layout')

@section('title', 'About')

@section('content')
<div class="container">
    <h1>About</h1>
    <hr>
    <div class="row about-card-container">
        <div class="col-md-4 col-sm-12">
            <img class="image" src="{{ asset('images/about1.jpg') }}" alt="About first Image">
        </div>
        <div class="col-md-8 about-card">
            <p>
                We zijn een jonge organisatie die een plek bieden voor mensen die hun ideeën willen delen met andere mensen in de wereld. <br>
                Deze mensen kunnen dus hun projecten of ideeën tentoonstellen met afbeeldingen. <br>
                Het is eigenlijk de bedoeling dat de gebruikers elkaar steunen. <br>
                De projecten die je hier kan terug vinden bevinden zich binnen allerlei categoriën. <br>
                Start nu met het maken van een account en deel je projecten met de wereld. <br>
                Het is zeer simpel! <br>
            </p>
        </div>
    </div>
    <hr>
    <div class="row about-card-container">
        <div class="col-md-8 about-card">
            <p>
                Maak je account aan of meld je aan en start met het kopen van Rocket Point credits.<br>
                Rocket Points zijn een representatie van echte euro's. <br>
                Deze credits kunnen gebruikt worden om projecten van mede creators te subsidiëren.<br>
                Deze helpen in het realiseren van het project.<br>
                Steun de ideeën waar je in geloofd! <br>
            </p>
        </div>
        <div class="col-md-4 col-sm-12">
            <img class="image" src="{{ asset('images/about2.jpg') }}" alt="About second Image">
        </div>
    </div>
</div>

@endsection