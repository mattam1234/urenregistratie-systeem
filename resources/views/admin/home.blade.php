@extends('layouts.app')
@unless (Auth::check())
    Je bent niet ingelogd.
@endunless
@section('style')
    <style>
        body {
            background-image: url("{{asset('images/background.png')}}");
        }

        .projecten {
            border: solid #808080 1px;
            border-radius: 5px;
            padding-top: 3px;
            padding-bottom: 3px;
            padding-left: 1px;
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

        .grid-button {
            height: 100%;
            display: grid;
            grid-template-rows: auto auto auto;
            grid-gap: 3em;
        }

        .grid-button-color {
            color: #FFFFFF !important;
        }
    </style>
@endsection
@section('content')
    <div class="grid-container">
        <div class="grid-item">
            @if($tasks)
                @foreach($tasks ?? '' as $task)
                    <div class="projecten">
                        Taak titel<br>
                        {{$task->title}}
                        <br>Taak Beschrijving<br>
                        {{$task->description }}
                        @if($task->status==='pending')
                            <div>
                                <p class="btn btn-outline-danger">Bezig</p>
                            </div>
                        @elseif($task->status==='completed')
                            <div>
                                <p class="btn-link btn-outline-success">Klaar</p>
                            </div>
                        @endif
                        <div>{{$task->hours}}</div>
                        <a href="/tasks/{{$task->id}}/edit" class="btn btn-primary mt-4">bekijk project</a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="grid-item">
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
        <div class="grid-item1 grid-button">
{{--            <div class="grid-item">--}}
{{--                <p>taak toewijzen aan medewerker</p>--}}
{{--                <a href="" class="btn btn-primary grid-button-color">toewijzen</a>--}}
{{--            </div>--}}
            <div class="grid-item">
                <p>catagorieën bekijken</p>
                <a href="/categories" class="btn btn-primary grid-button-color">bekijken</a>
                <p>catagorie maken</p>
                <a href="/categories/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
            <div class="grid-item">
                <p>alle projecten bekijken</p>
                <a href="/projects/all" class="btn btn-primary grid-button-color">alle projecten bekijken</a>
                <p>Openstaande projecten bekijken</p>
                <a href="/projects/ongoing" class="btn btn-primary grid-button-color">open project bekijken</a>
                <p>project aanmaken</p>
                <a href="/projects/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
            <div class="grid-item">
                <p>Project taken</p>
                <p>openstaande taken bekijken</p>
                <a href="/project_tasks/all" class="btn btn-primary grid-button-color">open taken bekijken</a>
                <p>taak aanmaken</p>
                <a href="/project_tasks/create" class="btn btn-primary grid-button-color">aanmaken</a>
            </div>
        </div>
        <div class="grid-item">
            <h4>
                Taak progressie
            </h4>
            @isset($teamTask)
                <div id="container" style="width: 100%; height: 100%;"></div>
            @endisset
            @empty($teamTask)
                <p>team heeft nog geen taken</p>
                <a href="/tasks/create" class="btn btn-primary mt-4">maak een taak</a>
                <br>
                <a href="/tasks/ongoing" class="btn btn-primary mt-4">open taken bekijken</a>
                <br>
                <a href="/tasks/share" class="btn btn-primary mt-4">deel een taak uit</a>
            @endempty
        </div>
        <div class="grid-item">
            <h4>
                Projecten
            </h4>
            @if($projecten)
                @foreach($projecten as $project)
                    <div class="projecten">
                        Project titel<br>
                        {{$project->title}}
                        <br>Project Beschrijving<br>
                        {{$project->description }}
                        <a href="/projects/{{$project->id}}/edit" class="btn btn-primary mt-4">bekijk project</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
