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
            font-size: 30px;
            border: #707070 solid 1px;
            background-color: #FFFFFF;
        }

        .grid-item1 {
            grid-row: 1/3;
        }

        p {
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <a href="home"><p>back</p></a>
    <div class="w-container custom-container">

        <div>
            @isset($verlof)
                <table class="table">
                    <thead>
                    <th scope="col">
                        Reden
                    </th>
                    <th scope="col">
                        Status
                    </th>
                    <th scope="col">
                        Begin datum
                    </th>
                    <th scope="col">
                        Eind datum
                    </th>
                    </thead>
                    @foreach($verlof as $verlof)
                        <tr>
                            <td>
                                {{$verlof->reden}}
                            </td>
                            <td>
                                {{$verlof->goedkeuring}}
                            </td>
                            <td>
                                {{$verlof->beginDatum}}
                            </td>
                            <td>
                                {{$verlof->eindDatum}}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>sorry geen aanvraag verlof gevonden ga <a href="/home">terug</a></p>
            @endif
        </div>

    </div>
@endsection

