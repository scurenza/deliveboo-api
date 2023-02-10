@php
    
    $productsList = Auth::user()->products;
    $productsAvailable = [];
    foreach ($productsList as $product) {
        if ($product->available == 1) {
            $productsAvailable[] = $product;
        }
    }
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-8 text-center">
                Ciao {{ Auth::user()->username }}, la tua mail è {{ Auth::user()->email }} e la tua VAT è
                {{ Auth::user()->VAT }}, la tua attività è {{ Auth::user()->name }}
                <ul>
                    @foreach (Auth::user()->types as $type)
                        <li>{{ $type->name }}</li>
                    @endforeach
                </ul>
            </div>

            @if (Auth::user()->img)
                <div class="col-md-8 text-center">
                    <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="">
                </div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        La tua lista di prodotti disponibili
                    </div>

                    @forelse ($productsAvailable as $product)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $product->name }} - {{ $product->price }}€</li>
                        </ul>
                    @empty
                        <p class="ms-3">Non hai prodotti disponibili</p>
                    @endforelse




                </div>
            </div>

            <div class="col-md-8 text-end">
                <a class="btn btn-primary" href="{{ route('products.index') }}">Guarda i tuoi prodotti</a>
            </div>

            {{-- <div class="col-8-md text-end">
                <form action="{{ route('profile.destroy') }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Cancella</button>
                </form>
            </div> --}}
        </div>
    </div>
@endsection
