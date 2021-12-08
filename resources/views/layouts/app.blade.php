<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aplikasi Pakar Illnes</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  {{-- summernote --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   </head>
<body>
    <div id="app">
        <div class="navbar navbar-light bg-white">
            <div class="container">
            <a class="navbar-brand me-3 text-primary" href="{{ url('/') }}">
                    Aplikasi Pakar Illnes
            </a>
            </div>
        </div>
        @guest
            
        @else
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    <h5 class="text-primary">Selamat Datang</h5>
                    @else
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-3">
                            <a class="nav-link @if (Route::is('diseases.index')) active @endif" aria-current="page" href="{{route('diseases.index')}}"><span><i class="fas fa-bacteria"></i></span> Penyakit</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link @if (Route::is('indications.index')) active @endif" aria-current="page" href="{{route('indications.index')}}"><span><i class="fab fa-creative-commons-sampling"></i></span> Gejala</a>
                        </li>
                        @role('psikolog')

                        @else
                        <li class="nav-item me-3">
                            <a class="nav-link @if (Route::is('psikologs.index')) active @endif" aria-current="page" href="{{route('psikologs.index')}}"><span><i class="fas fa-users"></i></span> Psikolog</a>
                        </li>
                        @endrole
                        <li class="nav-item me-3">
                            <a class="nav-link @if (Route::is('users.index')) active @endif" aria-current="page" href="{{route('users.index')}}"><span><i class="fas fa-user-circle"></i></span> Pengguna</a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link @if (Route::is('record')) active @endif" aria-current="page" href="{{route('record')}}"><span><i class="fas fa-notes-medical"></i></span> Track Record Users</a>
                        </li>
                    </ul>
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-sm btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item me-4">
                            <h6 class="text-secondary">{{ Auth::user()->name }}</h6>
                        </li>
                        <li class="nav-item">
                        <a class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        </li>
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endguest
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @stack('cari')
    @stack('summernote')
</body>
</html>
