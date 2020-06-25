@extends('layouts.app')
@section('title','Edit Category')
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
    <div class="grid-container">
        <div class="my-3 my-md-5">
            <div class="page-header d-flex justify-content-center">
                <h1 class="page-title">Bewerk Catagorie</h1>
            </div>
            <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-6">
                    <div class="card">
                        <div class="card-status bg-green"></div>
                        <div class="card-header">Bewerk Catagorie</div>
                        <div class="card-body">
                            @foreach($category as $each)
                                <form action="{{route('category.update',$each->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="category_title"
                                               class="form-control {{($errors->has('category_title'))?'is-invalid':''}}"
                                               value="{{$each->category_title}}" placeholder="Catagorie titel">
                                        @if($errors->has('category_title'))
                                            <p class="text-danger">{{$errors->first('category_title')}}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer float-right">
                                        <a href="{{route('category.index')}}" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

