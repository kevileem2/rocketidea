@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="box-shadow:0 5px 15px rgba(124,123,128,0.15);" class="card">
                <div style="text-align:center;background-color:white;" class="card-header"><h1>Aanmelden</h1></div>
                <div style="margin-top:20px;" class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Naam" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="E-mailadres" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Wachtwoord" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" placeholder="Wachtwoord bevestigen" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div style="margin-top:50px;" class="card-footer bg-transparent">
                            <div style="margin-top:20px;" class="form-group row justify-content-center">
                                <div class="col-md-6">
                                    <button type="submit" class="btn inverse-primary-button">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
