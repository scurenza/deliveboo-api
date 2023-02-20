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

        {{-- main --}}
        <div class="{{ Auth::user() ? 'd-flex' : '' }}" style="height:100vh">
            {{-- Sidebar --}}
            @if (Auth::user())
                <nav id="sidebarMenu" class="col-sm-4 col-md-3 col-lg-2 d-md-block navbar-dark sidebar">
                    <h1 class="ms_logo">Deliveboo</h1>
                    <div>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link sidebar-name {{ Route::currentRouteName() === 'home' ? 'bg-secondary' : '' }}"
                                    href="{{ url('/') }}">
                                    <i class="fa-solid fa-house"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-name {{ Route::currentRouteName() === 'products.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('products.index') }}">
                                    {{-- <i class="fa-solid fa-list"></i> --}}
                                    <i class="fa-solid fa-burger"></i>
                                    Prodotti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link sidebar-name {{ Route::currentRouteName() === 'orders.index' ? 'bg-secondary' : '' }}"
                                    href="{{ route('orders.index') }}">
                                    {{-- <i class="fa-solid fa-inbox"></i> --}}
                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                    Ordini
                                </a>
                            </li>
                            <li class="nav-item ms_logout">
                                <a class="nav-link sidebar-name" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                    Esci
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
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
        {{-- main --}}
    </div>
</body>

</html>
