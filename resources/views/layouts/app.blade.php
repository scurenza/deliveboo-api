<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app" class="vh-100">


        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height:10vh">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">
                        Deliveboo
                    </div>
                    {{-- config('app.name', 'Laravel') --}}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
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
        <div class="{{ Auth::user() ? 'd-flex' : '' }}" style="min-height:90vh">
            {{-- Sidebar --}}
            @if (Auth::user())
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark navbar-dark sidebar">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() === 'dashboard' ? 'bg-secondary' : '' }}"
                                    href="{{ route('dashboard') }}">
                                    <i class="fa-solid fa-tachometer-alt fa-lg fa-fw"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() === 'products.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('products.index') }}">
                                    <i class="fa-solid fa-list"></i>
                                    Prodotti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white {{ Route::currentRouteName() === 'orders.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('orders.index') }}">
                                    <i class="fa-solid fa-inbox"></i>
                                    Ordini ricevuti
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
                {{-- /Sidebar --}}
            @endif

            <main class="flex-grow-1">
                @yield('content')
            </main>
        </div>

    </div>
</body>

</html>
