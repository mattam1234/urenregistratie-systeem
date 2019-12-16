@extends('layouts.app')
@section('style')
    <style>
        body{
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
        .grid-item1{
            grid-row: 1/3;
        }
        p{
            font-size: 18px;
        }
    </style>
@endsection
@section('content')
    <a href="home"><p>back</p></a>
    <div class="w-container custom-container">

    </div>
@endsection

