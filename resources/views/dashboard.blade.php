@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

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
