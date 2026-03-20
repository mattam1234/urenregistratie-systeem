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
            <div class="mb-3">
                <a href="{{route('verlof.create')}}" class="btn btn-success">Verlof aanvragen</a>
            </div>
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
                    <th scope="col">
                        Acties
                    </th>
                    </thead>
                    @foreach($verlof as $verlofItem)
                        <tr>
                            <td>
                                {{$verlofItem->reden}}
                            </td>
                            <td>
                                {{$verlofItem->goedkeuring}}
                            </td>
                            <td>
                                {{$verlofItem->beginDatum}}
                            </td>
                            <td>
                                {{$verlofItem->eindDatum}}
                            </td>
                            <td>
                                <a href="{{route('verlof.edit', $verlofItem->id)}}" class="btn btn-info">Bewerken</a>
                                <form action="{{route('verlof.destroy', $verlofItem->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Weet je het zeker?')">Verwijderen</button>
                                </form>
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

