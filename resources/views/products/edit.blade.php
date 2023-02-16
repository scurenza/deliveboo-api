@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="text-center">Modifica un prodotto</div>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome prodotto*</label>
                <input type="text" value="{{ old('name', $product->name) }}" name="name" required class="form-control"
                    id="name" aria-describedby="nome">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione*</label>
                <textarea name="description" required id="description" class="form-control" cols="30">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo*</label>
                <input type="number" value="{{ old('price', $product->price) }}" name="price" required step="0.01"
                    class="form-control" id="price" aria-describedby="price">
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Immagine</label>
                <input type="file" name="img" class="form-control" id="img" aria-describedby="img">
                @if ($product->img)
                    <div>
                        <p class="mt-2 mb-0">Image preview:</p>
                        <div class="img-wrapper d-flex justify-content-center">
                            <img id="img-preview" src="{{ asset('storage/' . $product->img) }}" alt=""
                                style="max-width: 200px;">
                        </div>
                    </div>
                @endif
            </div>

            <div class="mb-3 form-check">
                <label for="available" class="form-label">Disponibile</label>
                <input type="checkbox" checked value="1" name="available" class="form-check-input" id="available">
            </div>
            <div class="mb-3">
                <span class="text-decoration-underline">I campi con * sono obbligatori</span>
            </div>
            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
        </form>
    </div>
@endsection
