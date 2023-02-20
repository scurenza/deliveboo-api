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
@section('content')
    {{-- view utente registrato --}}

    @if (Auth::user())
        <div style="height:90vh; width:100%">
            {{-- banner-home --}}
            <div class="banner-home">
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
            {{-- /banner-home --}}

            {{-- prodotti disponibili --}}
            <div class="container ms_cards-wrapper">
                @if (count($productsAvailable) > 0)
                    <div class="row row-cols-md-3">
                        @foreach ($productsAvailable as $product)
                            <div class="col">
                                {{-- card --}}
                                <div class="ms_card">
                                    <div class="ms_card-image"> <img src="{{ asset('storage/' . $product->img) }}"
                                            alt=""></div>
                                    <div class="ms_price"> {{ $product->price }} € </div>
                                    <div class="ms_heading"> {{ $product->name }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h1 class="text-center">Non ci sono prodotti disponibili</h1>
                @endif
            </div>
        </div>
        {{-- /prodotti disponibili --}}
    @else
        {{-- view utente non registrato --}}
        <div class="text-center home-guest">
            <h1>Deliveboo</h1>
            <div>
                <a class="btn" href="{{ route('login') }}">{{ __('Accedi') }}</a>
            </div>
            <div>
                <a class="btn" href="{{ route('register') }}">{{ __('Registrati') }}</a>
            </div>
        </div>
    @endif
@endsection
