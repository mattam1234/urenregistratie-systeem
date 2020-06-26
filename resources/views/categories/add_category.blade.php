@extends('layouts.app')
@section('title','TDS Maak een nieuwe catagorie')
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
            overflow: auto;
        }

        .grid-item {
            padding: 20px;
            border: #808080 solid 1px;
            border-radius: 5px;
            background-color: #FFFFFF;
        }
    </style>
@endsection
@section('content')
    <div class="page-header d-flex justify-content-center">
        <h1 class="page-title">Nieuwe catagorie aanmaken</h1>
    </div>
    <div class="row row-cards row-deck d-flex justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-status bg-green"></div>
                <div class="card-header">Catagorie toevoegen</div>
                <div class="card-body">
                    <form action="{{route('category.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="category_title"
                                   class="form-control {{($errors->has('category_title'))?'is-invalid':''}}"
                                   value="{{old('category_title')}}" placeholder="Catagorie titel...">
                            @if($errors->has('category_title'))
                                <p class="text-danger">{{$errors->first('category_title')}}</p>
                            @endif
                        </div>
                        <div class="card-footer float-right">
                            <a href="{{route('category.index')}}" class="btn btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

