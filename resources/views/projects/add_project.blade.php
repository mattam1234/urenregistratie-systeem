@extends('layouts.app')
@section('title','TSD Nieuw project aanmaken')
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
                <h1 class="page-title">Nieuw project maken</h1>
            </div>
            <div class="row row-cards row-deck d-flex justify-content-center">
                <div class="col-12">
                    @if($count==0)
                        <h3 class="text-info text-center">Sorry! Geen catagorieën gevonden.</h3>
                        <a href="{{route('category.create')}}" class="btn btn-info">Catagorie aanmaken.</a>
                    @else
                        <div class="card p-4">
                            <div class="card-body">
                                <form action="{{route('project.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text"
                                               class="form-control {{($errors->has('project_title'))?'is-invalid':''}}"
                                               value="{{old('project_title')}}" name="project_title"
                                               placeholder="Project titel...">
                                        @if($errors->has('project_title'))
                                            <p class="text-danger">{{$errors->first('project_title')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <select name="project_category"
                                                class="form-control  {{($errors->has('project_category'))?'is-invalid':''}}">
                                            <option value="">Kies een catagorie</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}" {{(old('project_category')==$category->id)?'selected':''}}>{{$category->category_title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('project_category'))
                                            <p class="text-danger">{{$errors->first('project_category')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Project start</label>
                                        <input type="date"
                                               class="form-control  {{($errors->has('start_date'))?'is-invalid':''}}"
                                               name="start_date" value="{{old('start_date')}}"
                                               placeholder="Kies start datum...">
                                        @if($errors->has('start_date'))
                                            <p class="text-danger">{{$errors->first('start_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Einde van het project</label>
                                        <input type="date"
                                               class="form-control  {{($errors->has('end_date'))?'is-invalid':''}}"
                                               name="end_date" value="{{old('end_date')}}" placeholder="kies eind datum...">
                                        @if($errors->has('end_date'))
                                            <p class="text-danger">{{$errors->first('end_date')}}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <textarea class="form-control {{($errors->has('description'))?'is-invalid':''}}"
                                              name="description"
                                              placeholder="Beschrijving van het project...">{{old('description')}}</textarea>
                                        @if($errors->has('description'))
                                            <p class="text-danger">{{$errors->first('description')}}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer float-right">
                                        <a href="{{route('project.all')}}" class="btn btn-danger">Cancel</a>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>
                </div>
            </div>
    </div>
@endsection
