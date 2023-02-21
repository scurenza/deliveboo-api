@extends('layouts.app')
@section('title', 'I tuoi prodotti')

@section('content')
    <div class="container p-4 overflow-scroll" style="height: 100vh">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        {{-- Modal --}}
        <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sei sicuro?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            {{-- <span aria-hidden="true">&times;</span> --}}
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="deleteModalText"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="delete-modal-btn">Cancella</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    </div>
                </div>
            </div>
        </div>

        @if (count($products) > 0)
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                {{-- card new product --}}
                <div class="col mb-3">
                    <a href="{{ route('products.create') }}" class="card add-new-btn">
                        <span>+</span>
                        <div class="add-card-hover">
                            Crea un nuovo Prodotto
                        </div>
                    </a>
                </div>
                {{-- card new product --}}
                @foreach ($products as $product)
                    <div class="col mb-3">
                        {{-- card --}}
                        <div class="card d-flex flex-column justify-content-between">
                            <div class="card-img-top">
                                @if ($product->img)
                                    <img src="{{ asset('storage/' . $product->img) }}"
                                        alt="{{ $product->img ? 'immagine di ' . $product->img : 'Immagine non disponibile' }}">
                                @else
                                    <img src="http://img.kpopmap.com/wp-content/uploads_kpopmap/2016/11/kpop-idols-beret-hats-2016-exo-do.jpg"
                                        alt="">
                                    <span></span>
                                @endif
                            </div>

                            {{-- card-body --}}
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $product->name }}</h5>

                                <ul class="list-group ms_list-card list-group-flush">
                                    <li class="list-group-item">
                                        <span>Descrizione:</span>
                                        <span class="prod-info">{{ $product->description }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Prezzo:</span>
                                        <span class="prod-info">{{ $product->price }} €</span>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Visibilità:</span>
                                        <span class="prod-info">
                                            {{ $product->available === 1 ? 'Visibile' : 'non visibile' }}
                                        </span>
                                    </li>
                                </ul>

                                <div class="d-flex justify-content-between mt-3 px-4">
                                    {{-- edit btn --}}
                                    <a href="{{ route('products.edit', $product->id) }}" class="card-edit-btn btn"><i
                                            class="fa-solid fa-pen"></i></a>
                                    {{-- edit btn --}}

                                    {{-- delete btn --}}
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="card-delete-btn ms-btn btn"
                                            data-product-name="{{ $product->name }}"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </form>
                                    {{-- delete btn --}}

                                </div>
                            </div>
                            {{-- card-body --}}

                        </div>
                        {{-- /card --}}
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center" style="height: 100%">
                <a href="{{ route('products.create') }}" class="btn hover-btn-secondary ms-btn-secondary">
                    Crea il tuo primo Prodotto
                </a>
            </div>
        @endif
    </div>
@endsection
