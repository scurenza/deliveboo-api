@extends('layouts.app')

@section('content')
    <div class="container p-4">
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

        <div class="row row-cols-md-3">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card d-flex flex-column justify-content-center" style="width: 18rem; height:100%">
                        <img class="card-img-top" src="{{ asset('storage/' . $product->img) }}"
                            alt="{{ $product->img ? 'immagine di ' . $product->img : 'Immagine non disponibile' }}">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>



                            <ul class="list-group ">
                                <li class="list-group-item">Descrizione: {{ $product->description }}</li>
                                <li class="list-group-item">Prezzo: {{ $product->price }} €</li>
                                <li class="list-group-item">Disponibilità:
                                    {{ $product->available === 1 ? 'disponibile' : 'non disponibile' }}</li>
                            </ul>

                            <div class="d-flex justify-content-center mt-3">
                                {{-- <button class="btn btn-success">Mostra</button> --}}
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"><i
                                        class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger ms-2 ms-btn"
                                        data-product-name="{{ $product->name }}">cancella</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="my-3 text-end">
            <a class="btn btn-primary" href="{{ route('products.create') }}">Inserisci un nuovo prodotto</a>
        </div>


        <!-- Modal della conferma prima della cancellazione -->
        {{-- <div class="modal fade" id="delete-project-{{ $project->id }}" tabindex="-1"
                                        aria-labelledby="delete-label-{{ $project->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="delete-label-{{ $project->id }}">Vuoi
                                                        cancellare {{ $project->title }}?</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{ route('admin.projects.destroy', $project->slug) }}"
                                                        method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            Cancella
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}



    </div>
@endsection
