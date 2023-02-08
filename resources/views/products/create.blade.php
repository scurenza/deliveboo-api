@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="text-center">Crea un nuovo prodotto</div>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome prodotto</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="nome">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea name="description" id="description" class="form-control" cols="30"></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" name="price" step="0.01" class="form-control" id="price"
                    aria-describedby="price">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Immagine</label>
                <input type="file" name="img" class="form-control" id="img" aria-describedby="img">
            </div>
            <div class="mb-3 form-check">
                <label for="available" class="form-label">Disponibile</label>
                <input type="checkbox" checked value="1" name="available" class="form-check-input" id="available">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
