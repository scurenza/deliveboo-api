@extends('layouts.app')
@section('title', 'I tuoi ordini')

@section('content')
    <div class="container overflow-scroll" style="height: 100vh">
        <div class="row row-cols-md-3">
            @foreach ($orders as $order)
                <div class="col">


                    <div class="card d-flex flex-column justify-content-center" style="width: 18rem; height:100%">
                        <div class="card-body">
                            <h5 class="card-title text-center">Ordinante: {{ $order->name }} {{ $order->last_name }}</h5>



                            <ul class="list-group ">
                                <li class="list-group-item">ID ordine: {{ $order->id }}</li>
                                <li class="list-group-item">numero di telefono: {{ $order->phone_number }}</li>
                                <li class="list-group-item">Indirizzo: {{ $order->address }}</li>
                                <li class="list-group-item">Totale: {{ $order->amount }}€</li>
                                {{-- <li class="list-group-item">Prezzo: {{ $product->price }} €</li>
                                <li class="list-group-item">Disponibilità:
                                    {{ $product->available === 1 ? 'disponibile' : 'non disponibile' }}</li> --}}
                            </ul>

                            <ul>
                                @foreach ($order->products as $product)
                                    <li class="list-group-item">nome prodotto: {{ $product->name }}, {{ $product->price }}€,
                                        x{{ $product->pivot->quantity }}</li>
                                @endforeach
                            </ul>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="my-3 text-end">
            {{-- <a class="btn btn-primary" href="{{ route('') }}">Vai a guardare le statistiche</a> --}}
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
