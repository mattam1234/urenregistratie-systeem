@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('style')
    <style>
        body {
            background-image: url("{{asset('images/background.png')}}");
        }

        .grid-container {
            height: 70%;
            display: grid;
            grid-template-columns: auto auto auto;
            grid-template-rows: auto auto;
            padding: 10px;
            grid-gap: 3em;
        }

        .grid-item {
            padding: 20px;
            border: #808080 solid 1px;
            border-radius: 5px;
            background-color: #FFFFFF;
        }

        .grid-item1 {
            grid-row: 1/3;
        }

        .grid-button{
            height: 100%;
            display: grid;
            grid-template-rows: auto auto auto;
            grid-gap: 3em;
        }

        .grid-button-color{
            color: #FFFFFF !important;
        }

        p {
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <div class="grid-container">
        <div class="grid-item grid-item1">
            @isset($currentjob)
                <h4>
                    Takenlijst
                </h4>
                <p>
                    actieve taak:
                </p>
                <p id="status">

                </p>
                <div>
                    <button class="btn btn-primary" onclick="startTimer()">start</button>
                    <button class="btn btn-primary" onclick="stopTimer()">stop</button>
                </div>
                <p>
                    progressie:
                </p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                         aria-valuemin="0" aria-valuemax="100" style="width:30%">
                    </div>
                </div>
                <p>
                    takenlijst inhoud:
                </p>
                <div class="taskcontainer">
                </div>
            @endisset
            @empty($currentjob)
                <p>Geen uren geregistreerd</p>
            @endempty
        </div>
        <div class="grid-item grid-item4">
            <h4>
                Verlof aanvragen
            </h4>
            {{ Form::open(['action' => "VerlofController@store" , 'method' => 'POST']) }}
            <div class="form-group">
                {{Form::label('reden', 'reden')}}
                {{Form::text('reden', '', ['class' => 'form-control', 'placeholder' => 'Reden'])}}
            </div>
            <div class="form-group">
                {{Form::label('BeginDatum', 'Begin datum')}}
                {{Form::date('BeginDatum', '', ['class' => 'form-control', 'placeholder' => 'Datum'])}}
            </div>
            <div class="form-group">
                {{Form::label('EindDatum', 'Eind datum')}}
                {{Form::date('EindDatum', '', ['class' => 'form-control', 'placeholder' => 'Datum'])}}
            </div>
            {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
            {{ Form::close() }}
            <a href="/verlof"><p>Zie verlof status.</p></a>
        </div>
        <div class="grid-item3 grid-button">
            <div class="grid-item">
                <p>taak toewijzen aan medewerker</p>
                <a href="" class="btn btn-primary grid-button-color">toewijzen</a>
            </div>
            <div class="grid-item">
                <p>catagorieën bekijken</p>
                <a href="/categories" class="btn btn-primary grid-button-color">bekijken</a>
                <p>catagorie maken</p>
                <a href="/categories/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
            <div class="grid-item">
                <p>project aanmaken</p>
                <a href="/projects/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
            <div class="grid-item">
                <p>taak aanmaken</p>
                <a href="/tasks/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
        </div>
        <div class="grid-item grid-item5">
            <h4>
                taak progressie
            </h4>
            @isset($teamTask)
                <div id="container" style="width: 100%; height: 100%;"></div>
            @endisset
            @empty($teamTask)
                <p>team heeft nog geen taaken</p>
                <a href="/tasks/create" class="btn btn-primary">maak een taak</a>
                <a href="/tasks/share" class="btn btn-primary">deel een taak uit</a>
            @endempty
        </div>
    </div>
@endsection
