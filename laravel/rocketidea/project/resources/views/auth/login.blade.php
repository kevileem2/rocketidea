@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="box-shadow:0 5px 15px rgba(124,123,128,0.15);"class="card">
                {{-- Card Header --}}
                <div style="text-align:center;background-color:white;"class="card-header"><h1>Inloggen</h1></div>
                {{-- Card Body --}}
                <div style="margin-top:20px;" class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        {{-- Email --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="E-mailadres" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Wachtwoord --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <input id="password" type="password" placeholder="Wachtwoord" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- Log In Button --}}
                        <div class="form-group row justify-content-md-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn inverse-primary-button">
                                    Inloggen bij Rocket Idea!
                                </button>
                            </div>
                        </div>
                        {{-- Footer --}}
                        <div style="margin-top:50px;"class="card-footer bg-transparent">
                            <div style="margin-top:20px;" class="form-group row justify-content-between">
                                {{-- Forgot your password --}}
                                <div style="display:inline-block;float:right;" class="form-check col-md-9">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                                {{-- Remember me --}}
                                <div style="display:inline-block" class="form-check col-md-3 ">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
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
