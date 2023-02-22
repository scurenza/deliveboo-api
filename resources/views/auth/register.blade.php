<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Registrati') }}</div>

                    <div class="card-body">
                        <form method="POST" id="register-form" enctype="multipart/form-data" action="{{ route('register') }}">
                            @csrf
                            {{-- name --}}
                            <div class="mb-4 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome attività*') }}</label>
                                <div class="col-md-6">
                                    <input data-name="nome attività" data-error="name" id="name" type="text"
                                        class="form-control ms_form @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    <div class="nameError text-danger">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- username --}}
                            <div class="mb-4 row">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nome utente*') }}</label>

                                <div class="col-md-6">
                                    <input data-name="nome utente" data-error="username" id="username" type="text"
                                        class="form-control ms_form @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    <div class="usernameError text-danger">
                                        @error('username')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- email --}}
                            <div class="mb-4 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo E-mail*') }}</label>

                                <div class="col-md-6">
                                    <input data-name="email" data-error="email" id="email" type="email"
                                        class="form-control ms_form @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    <div class="emailError text-danger">
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- address --}}
                            <div class="mb-4 row">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo*') }}</label>
                                <div class="col-md-6">
                                    <input data-name="indirizzo" data-error="address" id="address" type="text"
                                        class="form-control ms_form @error('address') is-invalid @enderror" name="address"
                                        value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    <div class="addressError text-danger">
                                        @error('address')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- vat --}}
                            <div class="mb-4 row">
                                <label for="VAT"
                                    class="col-md-4 col-form-label text-md-right">{{ __('P. IVA*') }}</label>

                                <div class="col-md-6">
                                    <input data-name="p.Iva" data-error="VAT" id="VAT" type="number" style=""
                                        class="form-control ms_form @error('VAT') is-invalid @enderror" name="VAT"
                                        value="{{ old('VAT') }}" required autocomplete="VAT" autofocus>

                                    <div class="vatError text-danger">
                                        @error('VAT')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- img --}}
                            <div class="mb-4 row">
                                <label for="img"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>
                                <div class="col-md-6">
                                    <input id="img" type="file"
                                        class="form-control @error('img') is-invalid @enderror" name="img"
                                        value="{{ old('img') }}" autofocus>

                                    @error('img')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <span>Seleziona una o più tipologie*</span>
                            {{-- types --}}
                            <div class="my-3 container">
                                <div
                                    class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 @error('types') is-invalid @enderror">
                                    @foreach ($types as $type)
                                        <div class="col mb-1">
                                            <input class="form-check-input" name="types[]" type="checkbox"
                                                value="{{ $type->id }}" @checked($errors->any() ? in_array($type->id, old('types', [])) : false)
                                                id="type-{{ $type->id }}">
                                            <label class="form-check-label" for="type-{{ $type->id }}">
                                                {{ $type->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    {{-- @error('types')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                    <div class="error-field">
                                        @error('types')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- password --}}
                            <div class="mb-4 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password*') }}</label>

                                <div class="col-md-6">
                                    <input data-error="passwordError" id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    <div class="passwordError text-danger">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- password confirm --}}
                            <div class="mb-4 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password*') }}</label>

                                <div class="col-md-6">
                                    <input data-error="passwordConfirmError" id="password-confirm" type="password"
                                        class="form-control" name="password_confirmation" required
                                        autocomplete="new-password">

                                    <div class="passwordConfirmError text-danger">
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- check if pass == confirm pass --}}
                            <div class="pass-match">

                            </div>

                            <div class="col-md-6 text-decoration-underline mb-4">
                                <span>I campi con * sono obbligatori</span>
                            </div>
                            <div class="mb-4 row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="button-submit" type="submit" class="btn btn-primary">
                                        {{ __('Registrati') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
