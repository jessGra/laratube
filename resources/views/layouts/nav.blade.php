<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand mr-5" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto flex-fill">
                  <form class="input-group my-2 mr-5" action="{{route('video.search')}}">
                    <input type="text" name="search" class="form-control text-white bg-primary" placeholder="Que quieres ver?" >
                    <div class="input-group-append">
                      <button class="btn btn-primary border bg-gray" type="submit" id="button-addon"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto nav-pills">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item text-center">
                            <a class="nav-link {{ setActive('login') }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item text-center">
                            <a class="nav-link {{ setActive('register') }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item mx-2 text-center">
                        <a class="nav-link text-white {{ setActive('subir') }}" href="{{route('video.subir')}}">{{ __('Upload Video') }}</a>
                    </li>
                    
                    <li class="nav-item dropdown mx-2 ">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesion') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>