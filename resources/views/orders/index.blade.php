@extends('layouts.app')
@section('title', 'I tuoi ordini')

@section('content')
    <div class="container overflow-scroll" style="height: 100vh">



        @if (count($orders) > 0)
            {{-- if order --}}
            <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                @foreach ($orders as $order)
                    <div class="col">

                        {{-- card --}}
                        <div class="card bg-my-secondary d-flex flex-column justify-content-center" style="height:100%">
                            <div class="card-body">
                                <h5 class="card-title text-center text-my-primary">Ordine: #{{ $order->id }}</h5>

                                <ul class="list-group ">
                                    <li class="list-group-item">
                                        <span>Cliente:</span>
                                        <div>{{ $order->name }} {{ $order->last_name }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Cellulare:</span>
                                        <div>{{ $order->phone_number }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Indirizzo:</span>
                                        <div>{{ $order->address }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Totale:</span>
                                        <div>{{ $order->amount }}€</div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Data:</span>
                                        <div>{{ date('d-m-y', strtotime($order->date)) }}</div>
                                    </li>
                                    <li class="list-group-item">
                                        <span>Ora:</span>
                                        <div>{{ date('H:i', strtotime($order->date)) }}</div>
                                    </li>
                                </ul>
                                <ul class="list-group pt-1">
                                    @foreach ($order->products as $product)
                                        <li class="list-group-item">
                                            <span>Prodotto:</span>
                                            <div>
                                                {{ $product->name }} x
                                                {{ $product->pivot->quantity }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- card --}}

                    </div>
                @endforeach
            </div>
            {{-- if order --}}
        @else
            <div class="d-flex justify-content-center align-items-center w-100" style="height: 100%;">
                <h1 class="text-my-primary">Non hai ricevuto alcun ordine</h1>
            </div>
        @endif
    </div>
@endsection
