@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>

            <div class="col-md-8 text-center">
                Ciao {{ Auth::user()->name }}, la tua mail è {{ Auth::user()->email }} e la tua VAT è
                {{ Auth::user()->VAT }}
            </div>

            <div class="col-md-8 text-center">
                <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="">
            </div>
        </div>
    </div>
@endsection
