@extends('layouts.app')
@section('title','Nieuwe taak maken')
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
                <h1 class="page-title">Maak een taak</h1>
            </div>
            <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-6">
                    @if($count==0)
                        <h3 class="text-info text-center">Sorry !Geen catagorie gevonden</h3>
                        <a href="{{route('category.create')}}" class="btn btn-info">Maak een catagorie</a>
                    @else
                        <div class="card">
                            <div class="card-status bg-green"></div>
                            <div class="card-header">Maak een taak</div>
                            <div class="card-body">
                                <form action="{{route('task.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="task_title"
                                               class="form-control {{($errors->has('task_title'))?'is-invalid':''}}"
                                               value="{{old('task_title')}}" placeholder="Taak titel...">
                                        @if($errors->has('task_title'))
                                            <p class="text-danger">{{$errors->first('task_title')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <select name="task_category" id=""
                                                class="form-control {{($errors->has('task_category'))?'is-invalid':''}}">
                                            <option value="">Kies een catagorie</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{(old('task_category')==$category->id)?'selected':''}}>{{$category->category_title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('task_category'))
                                            <p class="text-danger">{{$errors->first('task_category')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Begin datum</label>
                                        <input type="date" name="start_date" value="{{old('start_date')}}"
                                               class="form-control {{($errors->has('start_date'))?'is-invalid':''}}"
                                               placeholder="Kies begin datum...">
                                        @if($errors->has('start_date'))
                                            <p class="text-danger">{{$errors->first('start_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Eind datum</label>
                                        <input type="date" name="end_date" value="{{old('end_date')}}"
                                               class="form-control {{($errors->has('end_date'))?'is-invalid':''}}"
                                               placeholder="Kies eind datum...">
                                        @if($errors->has('end_date'))
                                            <p class="text-danger">{{$errors->first('end_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control {{($errors->has('description'))?'is-invalid':''}}"
                                                  name="description"
                                                  placeholder="Taak beschrijfing...">{{old('description')}}</textarea>
                                        @if($errors->has('description'))
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer float-right">
                                        <a href="{{route('task.ongoing')}}" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
