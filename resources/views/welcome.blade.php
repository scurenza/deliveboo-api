@php
    if (Auth::User()) {
        $productsList = Auth::user()->products;
        $productsAvailable = [];
        foreach ($productsList as $product) {
            if ($product->available == 1) {
                $productsAvailable[] = $product;
            }
        }
    }
    // dd($productsAviable)
@endphp
@extends('layouts.app')
@section('title', 'Deliveboo')
@section('content')

    {{-- view utente registrato --}}
    @if (Auth::user())
        <div class="overflow-scroll" style="height:100vh; width:100%">
            {{-- banner-home --}}
            <div class="banner-home">

                <h2 class="text-center title-sections">
                    I tuoi dati personali
                </h2>

                <div id="banner-container" class="d-flex justify-content-around align-items-center">
                    {{-- img --}}
                    <div class="banner-img-wrapper">
                        @if (Auth::user()->img)
                            <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="">
                        @endif
                    </div>
                    {{-- img --}}

                    {{-- data --}}
                    <ul class="list-group list-group-flush">
                        <li class="d-flex justify-content-between list-group-item">
                            <span>Nome Ristorante:</span>
                            <span>{{ Auth::user()->name }}</span>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <span>Nome Ristoratore:</span>
                            <span>{{ Auth::user()->username }}</span>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <span>Email:</span>
                            <span>{{ Auth::user()->email }}</span>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <span>Indirizzo:</span>
                            <span>{{ Auth::user()->address }}</span>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <span>P.Iva:</span>
                            <span>{{ Auth::user()->VAT }}</span>
                        </li>
                        <li class="d-flex justify-content-between list-group-item">
                            <span>Tipologia:</span>
                            <span>
                                @foreach (Auth::user()->types as $type)
                                    <div class="d-inline-block @if (count(Auth::user()->types) > 1) me-2 @endif">
                                        {{ $type->name }}
                                    </div>
                                @endforeach
                            </span>
                        </li>
                    </ul>
                    {{-- data --}}
                </div>

            </div>
            {{-- /banner-home --}}


            @if (count($productsAvailable) > 0)
                {{-- prodotti disponibili --}}
                <h2 class="text-center title-sections">I tuoi piatti visibili ai clienti</h2>
                <div class="ms_cards-wrapper">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                        @foreach ($productsAvailable as $product)
                            <div class="col">
                                {{-- card --}}
                                <div class="ms_card">
                                    <div class="ms_card-image">
                                        @if ($product->img)
                                            <img src="{{ asset('storage/' . $product->img) }}"alt="">
                                        @else
                                            <img src="http://img.kpopmap.com/wp-content/uploads_kpopmap/2016/11/kpop-idols-beret-hats-2016-exo-do.jpg"
                                                alt="">
                                        @endif
                                    </div>
                                    {{-- 
                                                @if ($product->img)
                                                    <img src="{{ asset('storage/' . $product->img) }}"
                                                        alt="{{ $product->img ? 'immagine di ' . $product->img : 'Immagine non disponibile' }}">
                                                @else
                                                    <img src="https://static.vecteezy.com/system/resources/thumbnails/005/725/214/small/concept-of-ban-burger-with-stop-sign-outline-icon-unhealthy-forbidden-food-line-icon-prohibition-of-eating-here-linear-pictogram-dont-allow-food-isolated-illustration-vector.jpg"
                                                        alt="">
                                                    <span></span>
                                                @endif
                                                --}}
                                    <div class="ms_price"> {{ $product->price }} € </div>
                                    <div class="ms_heading"> {{ $product->name }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <h2 class="text-center" style="padding-top: 4rem;">Non ci sono prodotti visibili ai clienti</h1>
            @endif
        </div>
        {{-- /prodotti disponibili --}}
    @else
        {{-- view utente non registrato --}}
        <div class="text-center home-guest">
            <div class="home-guest-container">
                <h1>Deliveboo</h1>
                <h3>Vuoi collaborare con noi? <br> Accedi o registrati come ristoratore alla piattaforma</h3>
                <div>
                    <a class="btn" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                </div>
                <div>
                    <a class="btn" href="{{ route('register') }}">{{ __('Registrati') }}</a>
                </div>
            </div>
        </div>
    @endif
@endsection
