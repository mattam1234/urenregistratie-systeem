@extends('layouts.app')
@section('title','Verlof bewerken')
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
        <h1 class="page-title">Verlof bewerken</h1>
    </div>
    <div class="row row-cards row-deck d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-status bg-green"></div>
                <div class="card-header">Verlof bewerken</div>
                <div class="card-body">
                    <form action="{{route('verlof.update', $verlof->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="reden">Reden</label>
                            <input type="text" name="reden"
                                   class="form-control {{($errors->has('reden'))?'is-invalid':''}}"
                                   value="{{old('reden', $verlof->reden)}}" placeholder="Reden voor verlof...">
                            @if($errors->has('reden'))
                                <p class="text-danger">{{$errors->first('reden')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="BeginDatum">Begin datum</label>
                            <input type="date" name="BeginDatum"
                                   class="form-control {{($errors->has('BeginDatum'))?'is-invalid':''}}"
                                   value="{{old('BeginDatum', $verlof->beginDatum)}}">
                            @if($errors->has('BeginDatum'))
                                <p class="text-danger">{{$errors->first('BeginDatum')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="EindDatum">Eind datum</label>
                            <input type="date" name="EindDatum"
                                   class="form-control {{($errors->has('EindDatum'))?'is-invalid':''}}"
                                   value="{{old('EindDatum', $verlof->eindDatum)}}">
                            @if($errors->has('EindDatum'))
                                <p class="text-danger">{{$errors->first('EindDatum')}}</p>
                            @endif
                        </div>
                        <div class="card-footer float-right">
                            <a href="{{route('verlof')}}" class="btn btn-danger">Annuleren</a>
                            <button type="submit" class="btn btn-success">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
