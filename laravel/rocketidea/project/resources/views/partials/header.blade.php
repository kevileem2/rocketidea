<nav class="nav grad">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <a class="logo" href="{{route('homePage')}}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
            </div>
            <div class="col-7">
                <div class="row vertical-align ">
                    <a class="nav-item nav-link @if(Route::is('/')) active @endif" href="{{route('homePage')}}">Home</a>
                    <a class="nav-item nav-link @if(Route::is('news.index')) active @endif" href="{{route('news.index')}}">News</a>
                    <a class="nav-item nav-link">Projects</a>
                    <a class="nav-item nav-link @if(Route::is('about')) active @endif" href="{{route('about')}}">About</a>
                    <a class="nav-item nav-link @if(Route::is('shop.index')) active @endif" href="{{route('shop.index')}}">Shop</a>
                </div>
            </div>
            <div class="col-4">
                <div class="row vertical-align justify-content-end">
                    @if(Auth::check())
                        <a class="nav-item nav-link">My Projects</a>
                        <button type="button" class="btn primary-button">
                            <span class="badge">You have {{Auth::user()->credits}} RP's</span>
                        </button>
                        <a class="nav-item nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a class="nav-item nav-link" href="{{route('login')}}">Sign In</a>
                        <a class="nav-item nav-link" href="{{route('register')}}">Sign Up</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>