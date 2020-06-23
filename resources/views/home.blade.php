@extends('layouts.app')
@unless (Auth::check())
    You are not signed in.
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

        .grid-item2 {
            grid-column: 2/4;
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
        <div class="grid-item grid-item2">
            @isset($team)
                <h4>
                    Team overzicht
                </h4>
                <p>Teamnaam: {{$team->name ?? ""}}</p>
                <p>Team genoten:</p>
                <div>
                    {{--                laat alle teamleden zien in text--}}
                    <table>
                        @foreach($teamleden ?? '' ?? '' as $teamlid)
                            <tr>
                                <td>
                                    {{ $teamlid->voorNaam }} {{ $teamlid->achterNaam}}
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
                <div>
                    <a href="teams/">bekijk Team</a>
                </div>
            @endisset
            @empty($team)
                <p>team niet gevonden vraag begeleiders.</p>
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
        <div class="grid-item grid-item5">
            <h4>
                uren overzicht
            </h4>
            @isset($currentjob)
                <div id="container" style="width: 100%; height: 100%;"></div>
            @endisset
            @empty($currentjob)

                <p>Geen uren geregistreerd</p>
            @endempty
        </div>
    </div>
@endsection
