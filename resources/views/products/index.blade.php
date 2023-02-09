@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="col-md-8 text-center">
            <a class="btn btn-secondary" href="{{ route('products.create') }}">Inserisci un nuovo prodotto</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Prezzo</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Disponibile</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $product->name }}</th>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <img class="w-50" src="{{ asset('storage/' . $product->img) }}"
                                alt="{{ $product->img ? 'immagine di ' . $product->img : 'Immagine non disponibile' }}">
                        </td>
                        <td>{{ $product->available === 1 ? 'disponibile' : 'non disponibile' }}</td>
                        <td>
                            <div>
                                {{-- <button class="btn btn-success">Mostra</button> --}}
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Modifica</a>
                                <button class="btn btn-danger">Cancella</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
