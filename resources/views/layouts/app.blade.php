<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Styles -->
        <link href="{!! asset('css/app.css') !!}" rel="stylesheet">
        <link href="{!! asset('css/zord.css') !!}" rel="stylesheet">
        <link href="{!! asset('css/font-awesome.css') !!}" rel="stylesheet">
        <link href="{{asset('css/lato.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <strong>{{ config('app.name', 'Laravel') }}</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
        <div class="row">
            @guest
        @else
        <div class="sidebar col-xs-2 col-sm-2 col-md-2 col-lg-2" style="position: relative !important">
            <!-- Left Side Of Navbar -->
            <ul class="">
                <li class="principal"><a href="{{ url('#') }}" class="text-blanco text-center text-bold">Menú navegación</a></li>
                <li class="{{Request::is('alerts') ? 'active' : '' }}"><a href="{{ url('alerts') }}" class="text text text-regular">Alertas</a></li>
                <li class="{{Request::is('administrador/nosotros') ? 'active' : '' }}"><a href="{{ url('administrador/nosotros') }}" class="text text text-regular">Nosotros</a></li>
                <li class="{{Request::is('administrador/servicios') ? 'active' : '' }}"><a href="{{ url('administrador/servicios') }}" class="text text text-regular">Nuestros Servicios</a></li>
                <li class="{{Request::is('administrador/proyectos') ? 'active' : '' }}"><a href="{{ url('administrador/proyectos') }}" class="text text text-regular">Mis Proyectos</a></li>
                <li class="{{Request::is('administrador/productos') ? 'active' : '' }}"><a href="{{ url('administrador/productos') }}" class="text text text-regular">Nuestros Productos</a></li>
                <li class="{{Request::is('administrador/clientes') ? 'active' : '' }}"><a href="{{ url('administrador/clientes') }}" class="text text text-regular">Nuestros Clientes</a></li>
                <li class="{{Request::is('administrador/contactos') ? 'active' : '' }}"><a href="{{ url('administrador/contactos') }}" class="text text text-regular">Listado Contacto</a></li>
                {{-- <li><a href="{{ url('administrador/portafolio') }}" class="text text text-regular">Portafolio</a></li> --}}
            </ul>
        </div>
        @endguest
        <div class="contenido col-xs-10 col-xs-offset-2 col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2 col-lg-12 col-lg-offset-2">
            <div class="panel-header">
                <!-- Nav tabs -->
            </div>
            @yield('content')
        </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
