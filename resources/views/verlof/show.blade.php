@extends('layouts.app')
@section('title','Verlof details')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('style')
    <style>
        body {
            background-image: url("{{asset('images/background.png')}}");
        }
    </style>
@endsection
@section('content')
    <div class="page-header d-flex justify-content-center">
        <h1 class="page-title">Verlof details</h1>
    </div>
    <div class="row row-cards row-deck d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Verlof details</div>
                <div class="card-body">
                    <p><strong>Reden:</strong> {{$verlof->reden}}</p>
                    <p><strong>Status:</strong> {{$verlof->goedkeuring}}</p>
                    <p><strong>Begin datum:</strong> {{$verlof->beginDatum}}</p>
                    <p><strong>Eind datum:</strong> {{$verlof->eindDatum}}</p>
                    <div class="card-footer float-right">
                        <a href="{{route('verlof')}}" class="btn btn-primary">Terug</a>
                        <a href="{{route('verlof.edit', $verlof->id)}}" class="btn btn-info">Bewerken</a>
                        <form action="{{route('verlof.destroy', $verlof->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
