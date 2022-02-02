 <nav style="background-color: #14aaf5" class="navbar navbar-expand-md navbar-dark  sticky-top shadow">
     <div class="container">
         <a class="navbar-brand" href="/">
             <img src="{{ asset('/storage/logo.png') }}" width="30" height="30" class="d-inline-block align-top mr-2"
                 alt="">
             Aplikasi Pakar Illnes
         </a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
             aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- Left Side Of Navbar -->
             @guest
                 <h5 class="text-primary">Selamat Datang</h5>
             @else
                 @role('psikolog|admin')
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item me-3">
                             <a class="nav-link @if (Route::is(['diseases.index', 'diseases.create', 'diseases.edit'])) active rounded text-white @endif" aria-current="page"
                                 href="{{ route('diseases.index') }}"><span><i class="fas fa-bacteria"></i></span>
                                 Penyakit</a>
                         </li>
                         <li class="nav-item me-3">
                             <a class="nav-link @if (Route::is(['indications.index', 'indications.create', 'indications.edit'])) active rounded text-white @endif" aria-current="page"
                                 href="{{ route('indications.index') }}"><span><i
                                         class="fab fa-creative-commons-sampling"></i></span> Gejala</a>
                         </li>
                         <li class="nav-item me-3">
                             <a class="nav-link @if (Route::is(['rules.index', 'rules.create', 'rules.edit'])) active rounded text-white  @endif" aria-current="page"
                                 href="{{ route('rules.index') }}"><span><i class="fas fa-cogs"></i></span> Rules</a>
                         </li>
                         @role('admin')
                             <li class="nav-item me-3">
                                 <a class="nav-link @if (Route::is('psikologs.index')) active rounded text-white @endif" aria-current="page"
                                     href="{{ route('psikologs.index') }}"><span><i class="fas fa-users"></i></span>
                                     Psikolog</a>
                             </li>

                         @else

                         @endrole
                         <li class="nav-item me-3">
                             <a class="nav-link @if (Route::is('users.index')) active rounded text-white @endif" aria-current="page"
                                 href="{{ route('users.index') }}"><span><i class="fas fa-user-circle"></i></span>
                                 Pengguna</a>
                         </li>
                         <li class="nav-item me-3">
                             <a class="nav-link @if (Route::is('record')) active rounded text-white @endif" aria-current="page"
                                 href="{{ route('record') }}"><span><i class="fas fa-notes-medical"></i></span> Track
                                 Record Users</a>
                         </li>
                     </ul>
                 @endrole
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
                     <li style="width:250px" class="nav-item row ml-1 align-items-center">
                         <div class="col-md-auto mr-3 col-sm-12 mb-1 mb-md-0 p-0">
                             <h6 class="text-white m-0 ">{{ Auth::user()->name }}</h6>
                         </div>
                         <div class="col-md col-sm-12 p-0">
                             <a class="btn btn-sm btn-danger" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();                                                                                                                                                                                                                                      document.getElementById('logout-form').submit();">
                                 <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
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
