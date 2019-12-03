@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="voornaam" class="col-md-4 col-form-label text-md-right">{{ __('voornaam') }}</label>

                            <div class="col-md-6">
                                <input id="voornaam" type="text" class="form-control @error('voornaam') is-invalid @enderror" name="voorNaam" value="{{ old('voornaam') }}" required autocomplete="voornaam" autofocus>

                                @error('voornaam')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="achternaam" class="col-md-4 col-form-label text-md-right">{{ __('achternaam') }}</label>

                            <div class="col-md-6">
                                <input id="achternaam" type="text" class="form-control @error('achternaam') is-invalid @enderror" name="achterNaam" value="{{ old('achternaam') }}" required autocomplete="achternaam" autofocus>

                                @error('achternaam')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="functie" class="col-md-4 col-form-label text-md-right">{{ __('functie') }}</label>

                            <div class="col-md-6">
                                <select id="functieId" name="functieId" class="form-control">
                                    <option class="form-control" >Functie</option>
                                    <option value="1" class="form-control" >werknemer</option>
                                    <option value="2" class="form-control" >manager</option>
                                    <option value="3" class="form-control" >leiding manager</option>
                                    <option value="4" class="form-control" >baas</option>
                                </select>
                                @error('functie')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('postcode') }}</label>

                            <div class="col-md-6">
                                <input id="postcode" type="text" class="form-control" name="postcode" required autocomplete="postcode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="woonplaats" class="col-md-4 col-form-label text-md-right">{{ __('woonplaats') }}</label>

                            <div class="col-md-6">
                                <input id="woonplaats" type="text" class="form-control" name="woonplaats" required autocomplete="woonplaats">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="adress" class="col-md-4 col-form-label text-md-right">{{ __('adress') }}</label>

                            <div class="col-md-6">
                                <input id="adress" type="text" class="form-control" name="adress" required autocomplete="adress">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefoonnummer" class="col-md-4 col-form-label text-md-right">{{ __('telefoonnummer') }}</label>

                            <div class="col-md-6">
                                <input id="telefoonnummer" type="tel" class="form-control" name="telefoonNummer" required autocomplete="telefoonnummer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noodnummer" class="col-md-4 col-form-label text-md-right">{{ __('noodnummer') }}</label>

                            <div class="col-md-6">
                                <input id="noodnummer" type="tel" class="form-control" name="noodNummer" required autocomplete="noodnummer">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="geboortedatum" class="col-md-4 col-form-label text-md-right">{{ __('geboortedatum') }}</label>

                            <div class="col-md-6">
                                <input id="geboortedatum" type="date" class="form-control" name="geboorteDatum" required autocomplete="geboortedatum">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
